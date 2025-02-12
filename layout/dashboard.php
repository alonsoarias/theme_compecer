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
 * A dashboard layout for the moove theme.
 *
 * @package    theme_moove
 * @copyright  2024 Your Name
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
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

// Get session key for logout and role switching
$sesskey = sesskey();

// Check if user has roles that can be switched
$hasroles = has_capability('moodle/role:switchroles', context_course::instance($COURSE->id));

// Define complete navigation menu items
$menuitems = [
    [
        'url' => new moodle_url('/my/'),
        'title' => get_string('myhome'),
        'icon' => 'fa fa-tachometer',  // Dashboard icon
        'key' => 'home',
        'active' => $PAGE->url->compare(new moodle_url('/my/'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/user/profile.php'),
        'title' => get_string('profile'),
        'icon' => 'fa fa-user',  // User icon
        'key' => 'profile',
        'active' => $PAGE->url->compare(new moodle_url('/user/profile.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/grade/report/overview/index.php'),
        'title' => get_string('grades'),
        'icon' => 'fa fa-graduation-cap',  // Graduation cap icon
        'key' => 'grades',
        'active' => $PAGE->url->compare(new moodle_url('/grade/report/overview/index.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/message/index.php'),
        'title' => get_string('messages', 'message'),
        'icon' => 'fa fa-comments',  // Comments icon
        'key' => 'messages',
        'active' => $PAGE->url->compare(new moodle_url('/message/index.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/calendar/view.php'),
        'title' => get_string('calendar', 'calendar'),
        'icon' => 'fa fa-calendar',  // Calendar icon
        'key' => 'calendar',
        'active' => $PAGE->url->compare(new moodle_url('/calendar/view.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/user/files.php'),
        'title' => get_string('privatefiles'),
        'icon' => 'fa fa-file',  // File icon
        'key' => 'files',
        'active' => $PAGE->url->compare(new moodle_url('/user/files.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/user/preferences.php'),
        'title' => get_string('preferences'),
        'icon' => 'fa fa-cog',  // Cog/settings icon
        'key' => 'preferences',
        'active' => $PAGE->url->compare(new moodle_url('/user/preferences.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/login/logout.php', ['sesskey' => $sesskey]),
        'title' => get_string('logout'),
        'icon' => 'fa fa-sign-out',  // Sign out icon
        'key' => 'logout'
    ]
];

// Add role switcher if user has capability
if ($hasroles) {
    $menuitems[] = [
        'url' => new moodle_url('/course/switchrole.php', [
            'id' => $COURSE->id,
            'sesskey' => $sesskey,
            'switchrole' => -1,
            'returnurl' => $PAGE->url->out_as_local_url(false)
        ]),
        'title' => get_string('switchroleto'),
        'icon' => 'fa fa-user-secret',  // User secret/role icon
        'key' => 'switchrole'
    ];
}

$bodyattributes = $OUTPUT->body_attributes($extraclasses);
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
    'enablecourseindex' => $themesettings->enablecourseindex,
    // Dashboard specific variables
    'dashboardmenuitems' => $menuitems,
    'sesskey' => $sesskey,
    'hasroles' => $hasroles,
    'courseid' => $COURSE->id
];

$templatecontext = array_merge($templatecontext, $themesettings->footer());

echo $OUTPUT->render_from_template('theme_compecer/dashboard', $templatecontext);