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
 * A my dashboard layout for the compecer theme.
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
$courseindexopen = false;
$blockdraweropen = false;

if (isloggedin()) {
    $courseindexopen = (get_user_preferences('drawer-open-index', true) == true);
    $blockdraweropen = (get_user_preferences('drawer-open-block') == true);
}

if (defined('BEHAT_SITE_RUNNING') && get_user_preferences('behat_keep_drawer_closed') != 1) {
    $blockdraweropen = true;
}

// Handle drawer states.
$extraclasses = ['uses-drawers'];
if ($courseindexopen) {
    $extraclasses[] = 'drawer-open-index';
}

// Check for blocks.
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = (strpos($blockshtml, 'data-block=') !== false || !empty($addblockbutton));
if (!$hasblocks) {
    $blockdraweropen = false;
}

// Load theme settings.
$themesettings = new \theme_moove\util\settings();

// Check course index.
$courseindex = '';
if ($themesettings->enablecourseindex) {
    $courseindex = core_course_drawer();
}

if (!$courseindex) {
    $courseindexopen = false;
}

// Check for forced blocks.
$forceblockdraweropen = $OUTPUT->firstview_fakeblocks();

// Handle secondary navigation.
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

// Setup primary navigation.
$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);

// Setup region main settings.
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions() && !$PAGE->has_secondary_navigation();
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

// Get header content.
$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

// Get session key and check roles.
$sesskey = sesskey();
$hasroles = has_capability('moodle/role:switchroles', context_course::instance($COURSE->id));

// Setup dashboard menu items.
$dashboardmenuitems = [
    [
        'url' => new moodle_url('/my/'),
        'title' => get_string('myhome'),
        'icon' => 'fa-tachometer',
        'key' => 'home',
        'active' => $PAGE->url->compare(new moodle_url('/my/'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/user/profile.php'),
        'title' => get_string('profile'),
        'icon' => 'fa-user',
        'key' => 'profile',
        'active' => $PAGE->url->compare(new moodle_url('/user/profile.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/grade/report/overview/index.php'),
        'title' => get_string('grades'),
        'icon' => 'fa-graduation-cap',
        'key' => 'grades',
        'active' => $PAGE->url->compare(new moodle_url('/grade/report/overview/index.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/message/index.php'),
        'title' => get_string('messages', 'message'),
        'icon' => 'fa-comments',
        'key' => 'messages',
        'active' => $PAGE->url->compare(new moodle_url('/message/index.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/calendar/view.php'),
        'title' => get_string('calendar', 'calendar'),
        'icon' => 'fa-calendar',
        'key' => 'calendar',
        'active' => $PAGE->url->compare(new moodle_url('/calendar/view.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/user/files.php'),
        'title' => get_string('privatefiles'),
        'icon' => 'fa-file',
        'key' => 'files',
        'active' => $PAGE->url->compare(new moodle_url('/user/files.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/user/preferences.php'),
        'title' => get_string('preferences'),
        'icon' => 'fa-cog',
        'key' => 'preferences',
        'active' => $PAGE->url->compare(new moodle_url('/user/preferences.php'), URL_MATCH_BASE)
    ],
    [
        'url' => new moodle_url('/login/logout.php', ['sesskey' => $sesskey]),
        'title' => get_string('logout'),
        'icon' => 'fa-sign-out',
        'key' => 'logout'
    ]
];

// Add role switcher if user has capability.
if ($hasroles) {
    $dashboardmenuitems[] = [
        'url' => new moodle_url('/course/switchrole.php', [
            'id' => $COURSE->id,
            'sesskey' => $sesskey,
            'switchrole' => -1,
            'returnurl' => $PAGE->url->out_as_local_url(false)
        ]),
        'title' => get_string('switchroleto'),
        'icon' => 'fa-user-secret',
        'key' => 'switchrole'
    ];
}

// Dashboard Cards configuration with responsive settings
$dashboardcards = array();
$enabledashboardcards = get_config('theme_compecer', 'enable_dashboard_cards');

if ($enabledashboardcards) {
    // Definimos las clases responsivas base
    $responsive_classes = array(
        'base' => 'col-12',          // Móviles pequeños (<576px)
        'sm' => 'col-sm-6',          // Móviles (≥576px)
        'md' => 'col-md-6',          // Tablets (≥768px)
        'lg' => 'col-lg-4',          // Desktops (≥992px)
        'xl' => 'col-xl-3'           // Desktops grandes (≥1200px)
    );

    // Colores predeterminados para las cards
    $default_colors = [
        '#4361ee',  // Azul
        '#f72585',  // Rosa
        '#2ec4b6',  // Verde azulado
        '#f9c74f'   // Amarillo
    ];

    for ($i = 1; $i <= 4; $i++) {
        if (get_config('theme_compecer', "dashboard_card_{$i}_visibility")) {
            $cardColor = get_config('theme_compecer', "dashboard_card_{$i}_color");
            // Si no hay color definido, usar uno predeterminado
            if (empty($cardColor)) {
                $cardColor = $default_colors[($i - 1) % count($default_colors)];
            }

            $dashboardcards[] = array(
                'title' => format_string(get_config('theme_compecer', "dashboard_card_{$i}_title")),
                'subtitle' => format_string(get_config('theme_compecer', "dashboard_card_{$i}_subtitle")),
                'url' => new moodle_url(get_config('theme_compecer', "dashboard_card_{$i}_url")),
                'color' => clean_param($cardColor, PARAM_TEXT),
                'iconclass' => clean_param(get_config('theme_compecer', "dashboard_card_{$i}_icon"), PARAM_ALPHANUMEXT),
                'responsive_classes' => implode(' ', $responsive_classes),
                'order' => $i,
                'card_id' => "dashboard-card-{$i}"
            );
        }
    }
    
    // Ordenar cards según configuración
    usort($dashboardcards, function($a, $b) {
        return $a['order'] - $b['order'];
    });
}

// Build template context.
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $OUTPUT->body_attributes($extraclasses),
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
    // Dashboard specific data
    'dashboardmenuitems' => $dashboardmenuitems,
    'sesskey' => $sesskey,
    'hasroles' => $hasroles,
    'courseid' => $COURSE->id,
    // Dashboard cards data with responsive settings
    'dashboardcards' => $dashboardcards,
    'hasdashboardcards' => !empty($dashboardcards),
    'enabledashboardcards' => $enabledashboardcards,
    'responsive_classes' => $responsive_classes
];

// Merge with theme settings.
$templatecontext = array_merge($templatecontext, $themesettings->footer());

// Render the template.
echo $OUTPUT->render_from_template('theme_compecer/mydashboard', $templatecontext);