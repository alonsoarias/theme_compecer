<?php
/**
 * MyDashboard layout for theme_compecer.
 *
 * @package    theme_compecer
 * @copyright  2024 Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/behat/lib.php');
require_once($CFG->dirroot . '/course/lib.php');

// Add block button in editing mode.
$addblockbutton = $OUTPUT->addblockbutton();

// Drawer open states.
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

$themesettings = new \theme_moove\util\settings();
if (!$themesettings->enablecourseindex) {
    $courseindex = '';
} else {
    $courseindex = core_course_drawer();
}
if (!$courseindex) {
    $courseindexopen = false;
}

$forceblockdraweropen = $OUTPUT->firstview_fakeblocks();

// Secondary navigation.
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

// Primary navigation.
$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);

// Header content.
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions() && !$PAGE->has_secondary_navigation();
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;
$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

// Body attributes.
$bodyattributes = $OUTPUT->body_attributes($extraclasses);

// Dashboard Cards configuration.
$dashboardcards = array();

// Only process cards if the feature is enabled
if (get_config('theme_compecer', 'enable_dashboard_cards')) {
    for ($i = 1; $i <= 4; $i++) {
        // Add card if it is marked as visible.
        if (get_config('theme_compecer', "dashboard_card_{$i}_visibility")) {
            $dashboardcards[] = array(
                'title'     => get_config('theme_compecer', "dashboard_card_{$i}_title"),
                'subtitle'  => get_config('theme_compecer', "dashboard_card_{$i}_subtitle"),
                'url'       => get_config('theme_compecer', "dashboard_card_{$i}_url"),
                'color'     => get_config('theme_compecer', "dashboard_card_{$i}_color"),
                'iconclass' => get_config('theme_compecer', "dashboard_card_{$i}_icon")
            );
        }
    }
}

// Template context.
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
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
    'enablecourseindex' => $themesettings->enablecourseindex,
    // Dashboard cards data
    'dashboardcards' => $dashboardcards,
    'hasdashboardcards' => !empty($dashboardcards),
    'enabledashboardcards' => get_config('theme_compecer', 'enable_dashboard_cards')
];

// Merge with theme settings.
$templatecontext = array_merge($templatecontext, $themesettings->footer());

// Render the template.
echo $OUTPUT->render_from_template('theme_compecer/mydashboard', $templatecontext);