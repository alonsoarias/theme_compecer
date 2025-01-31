<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Frontpage layout for the compecer theme.
 *
 * @package    theme_compecer
 * @copyright  2024 IngeWeb https://www.ingeweb.co
 * @author     Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/behat/lib.php');
require_once($CFG->dirroot . '/course/lib.php');

// Add block button in editing mode.
$addblockbutton = $OUTPUT->addblockbutton();

if (isloggedin()) {
    $courseindexopen = (get_user_preferences('drawer-open-index', true) == true);
    $blockdraweropen = (get_user_preferences('drawer-open-block') == true);
} else {
    $courseindexopen = false;
    $blockdraweropen = false;
}

if (defined('BEHAT_SITE_RUNNING') && get_user_preferences('behat_keep_drawer_closed') != 1) {
    $blockdraweropen = true;
}

$extraclasses = ['uses-drawers'];
if ($courseindexopen) {
    $extraclasses[] = 'drawer-open-index';
}

$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = (strpos($blockshtml, 'data-block=') !== false || !empty($addblockbutton));
if (!$hasblocks) {
    $blockdraweropen = false;
}

$courseindex = core_course_drawer();
if (!$courseindex) {
    $courseindexopen = false;
}

$forceblockdraweropen = $OUTPUT->firstview_fakeblocks();

$secondarynavigation = false;
$overflow = '';
if ($PAGE->has_secondary_navigation()) {
    $secondary = $PAGE->secondarynav;

    if ($secondary->get_children_key_list()) {
        $tablistnav = $PAGE->has_tablist_secondary_navigation();
        $moremenu = new \core\navigation\output\more_menu($PAGE->secondarynav, 'nav-tabs', true, $tablistnav);
        $secondarynavigation = $moremenu->export_for_template($OUTPUT);
        $extraclasses[] = 'has-secondarynavigation';
    }

    $overflowdata = $PAGE->secondarynav->get_overflow_menu_data();
    if (!is_null($overflowdata)) {
        $overflow = $overflowdata->export_for_template($OUTPUT);
    }
}

$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions() && !$PAGE->has_secondary_navigation();
// If the settings menu will be included in the header then don't add it here.
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

$bodyattributes = $OUTPUT->body_attributes($extraclasses);

// Basic template context.
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => \core\context\course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'courseindexopen' => $courseindexopen,
    'blockdraweropen' => $blockdraweropen,
    'courseindex' => $courseindex,
    'primarymoremenu' => $primarymenu['moremenu'],
    'secondarymoremenu' => $secondarynavigation ?: false,
    'mobileprimarynav' => $primarymenu['mobileprimarynav'],
    'usermenu' => $primarymenu['user'],
    'langmenu' => $primarymenu['lang'],
    'forceblockdraweropen' => $forceblockdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'overflow' => $overflow,
    'headercontent' => $headercontent,
    'addblockbutton' => $addblockbutton,
];

// Get theme settings
$themesettings = new \theme_moove\util\settings();

// Merge theme settings with base context
$templatecontext = array_merge($templatecontext, $themesettings->footer());

// Handle slider content
if (!empty($PAGE->theme->settings->slidercount)) {
    $templatecontext['slidercount'] = true;
    $slides = [];
    
    for ($i = 1; $i <= $PAGE->theme->settings->slidercount; $i++) {
        $slidetitle = $PAGE->theme->settings->{"slidertitle{$i}"} ?? '';
        $slidercaption = $PAGE->theme->settings->{"slidercaption{$i}"} ?? '';
        $sliderimage = $PAGE->theme->setting_file_url("sliderimage{$i}", "sliderimage{$i}");
        
        if ($sliderimage) {
            $slides[] = [
                'key' => $i - 1,
                'active' => $i === 1,
                'image' => $sliderimage,
                'slidertitle' => $slidetitle,
                'title' => $slidetitle,
                'caption' => $slidercaption,
                'hascaption' => !empty($slidetitle) || !empty($slidercaption)
            ];
        }
    }
    
    $templatecontext['slides'] = $slides;
    $templatecontext['slidersingleslide'] = count($slides) === 1;
}

// Manejo de la sección "Qué es/Qué somos"
if (!empty($PAGE->theme->settings->abouttitle) || !empty($PAGE->theme->settings->aboutcontent)) {
    $templatecontext['aboutsection'] = true;
    $templatecontext['abouttitle'] = format_text($PAGE->theme->settings->abouttitle ?? '', FORMAT_HTML);
    $templatecontext['aboutcontent'] = format_text($PAGE->theme->settings->aboutcontent ?? '', FORMAT_HTML);
}

// Manejo de las cajas de carrera
if (!empty($PAGE->theme->settings->enablecareerboxes)) {
    $templatecontext['careerboxes'] = true;
    
    // Configuración de las tres cajas
    $boxes = [];
    for ($i = 1; $i <= 3; $i++) {
        if (!empty($PAGE->theme->settings->{"careerbox{$i}title"})) {
            $boxes[] = [
                'icon' => $PAGE->theme->settings->{"careerbox{$i}icon"} ?? 'graduation-cap',
                'title' => format_text($PAGE->theme->settings->{"careerbox{$i}title"} ?? '', FORMAT_HTML),
                'content' => format_text($PAGE->theme->settings->{"careerbox{$i}content"} ?? '', FORMAT_HTML)
            ];
        }
    }
    $templatecontext['boxes'] = $boxes;
}

// Manejo de FAQ si está habilitado
if (!empty($PAGE->theme->settings->faqenabled)) {
    $templatecontext['faqenabled'] = true;
    $faqs = [];
    
    for ($i = 1; $i <= 5; $i++) {
        if (!empty($PAGE->theme->settings->{"faq{$i}question"})) {
            $faqs[] = [
                'id' => $i,
                'question' => format_text($PAGE->theme->settings->{"faq{$i}question"} ?? '', FORMAT_HTML),
                'answer' => format_text($PAGE->theme->settings->{"faq{$i}answer"} ?? '', FORMAT_HTML)
            ];
        }
    }
    $templatecontext['faq'] = $faqs;
}

    echo $OUTPUT->render_from_template('theme_compecer/theme_moove/frontpage', $templatecontext);
