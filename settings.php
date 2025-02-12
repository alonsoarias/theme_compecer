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
 * Theme settings file.
 *
 * @package    theme_compecer
 * @copyright  2024 Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/classes/admin_settingspage_tabs.php');

if ($ADMIN->fulltree) {

    // -------------------------------------------------------------------------
    // Unificación del array de íconos: usado en dashboard cards, career boxes, etc.
    // -------------------------------------------------------------------------
    $icons = [
        // Iconos originales
        'message'            => get_string('icon_message', 'theme_compecer'),
        'user'               => get_string('icon_user', 'theme_compecer'),
        'cog'                => get_string('icon_settings', 'theme_compecer'),
        'chart-bar'          => get_string('icon_chart', 'theme_compecer'),
        'graduation-cap'     => get_string('icon_graduation', 'theme_compecer'),
        'book'               => get_string('icon_book', 'theme_compecer'),
        'laptop'             => get_string('icon_laptop', 'theme_compecer'),
        'users'              => get_string('icon_users', 'theme_compecer'),
        'globe'              => get_string('icon_globe', 'theme_compecer'),
        'lightbulb'          => get_string('icon_lightbulb', 'theme_compecer'),
        'certificate'        => get_string('icon_certificate', 'theme_compecer'),
        'chart-line'         => get_string('icon_chart', 'theme_compecer'),
        'medal'              => get_string('icon_medal', 'theme_compecer'),
        'star'               => get_string('icon_star', 'theme_compecer'),
        'rocket'             => get_string('icon_rocket', 'theme_compecer'),
        'code'               => get_string('icon_code', 'theme_compecer'),
        'microscope'         => get_string('icon_microscope', 'theme_compecer'),
        'flask'              => get_string('icon_flask', 'theme_compecer'),
        'atom'               => get_string('icon_atom', 'theme_compecer'),
        'brain'              => get_string('icon_brain', 'theme_compecer'),
        'university'         => get_string('icon_university', 'theme_compecer'),
        'award'              => get_string('icon_award', 'theme_compecer'),
        'user-graduate'      => get_string('icon_usergraduate', 'theme_compecer'),
        'chalkboard-teacher' => get_string('icon_teacher', 'theme_compecer'),
    
        // Iconos académicos adicionales
        'book-reader'        => get_string('icon_bookreader', 'theme_compecer'),
        'book-open'          => get_string('icon_bookopen', 'theme_compecer'),
        'books'              => get_string('icon_books', 'theme_compecer'),
        'pen'                => get_string('icon_pen', 'theme_compecer'),
        'pencil-alt'         => get_string('icon_pencil', 'theme_compecer'),
        'marker'             => get_string('icon_marker', 'theme_compecer'),
        'highlighter'        => get_string('icon_highlighter', 'theme_compecer'),
        
        // Iconos de tecnología
        'desktop'            => get_string('icon_desktop', 'theme_compecer'),
        'laptop-code'        => get_string('icon_laptopcode', 'theme_compecer'),
        'mobile'             => get_string('icon_mobile', 'theme_compecer'),
        'tablet'             => get_string('icon_tablet', 'theme_compecer'),
        'keyboard'           => get_string('icon_keyboard', 'theme_compecer'),
        'mouse'              => get_string('icon_mouse', 'theme_compecer'),
        'wifi'               => get_string('icon_wifi', 'theme_compecer'),
        'signal'             => get_string('icon_signal', 'theme_compecer'),
        
        // Iconos de ciencia
        'dna'                => get_string('icon_dna', 'theme_compecer'),
        'vial'               => get_string('icon_vial', 'theme_compecer'),
        'magnet'             => get_string('icon_magnet', 'theme_compecer'),
        'glasses'            => get_string('icon_glasses', 'theme_compecer'),
        'telescope'          => get_string('icon_telescope', 'theme_compecer'),
        'microscope'         => get_string('icon_microscope', 'theme_compecer'),
        
        // Iconos de negocios y productividad
        'briefcase'          => get_string('icon_briefcase', 'theme_compecer'),
        'calculator'         => get_string('icon_calculator', 'theme_compecer'),
        'calendar'           => get_string('icon_calendar', 'theme_compecer'),
        'clock'              => get_string('icon_clock', 'theme_compecer'),
        'tasks'              => get_string('icon_tasks', 'theme_compecer'),
        'clipboard'          => get_string('icon_clipboard', 'theme_compecer'),
        'clipboard-check'    => get_string('icon_clipboardcheck', 'theme_compecer'),
        'clipboard-list'     => get_string('icon_clipboardlist', 'theme_compecer'),
        
        // Iconos de comunicación
        'comments'           => get_string('icon_comments', 'theme_compecer'),
        'comment-dots'       => get_string('icon_commentdots', 'theme_compecer'),
        'envelope'           => get_string('icon_envelope', 'theme_compecer'),
        'bell'               => get_string('icon_bell', 'theme_compecer'),
        'broadcast-tower'    => get_string('icon_broadcast', 'theme_compecer'),
        'bullhorn'           => get_string('icon_bullhorn', 'theme_compecer'),
        
        // Iconos de logros y progreso
        'trophy'             => get_string('icon_trophy', 'theme_compecer'),
        'crown'              => get_string('icon_crown', 'theme_compecer'),
        'medal'              => get_string('icon_medal', 'theme_compecer'),
        'badge'              => get_string('icon_badge', 'theme_compecer'),
        'certificate'        => get_string('icon_certificate', 'theme_compecer'),
        'stamp'              => get_string('icon_stamp', 'theme_compecer'),
        
        // Iconos de creatividad y arte
        'palette'            => get_string('icon_palette', 'theme_compecer'),
        'paint-brush'        => get_string('icon_paintbrush', 'theme_compecer'),
        'music'              => get_string('icon_music', 'theme_compecer'),
        'theater-masks'      => get_string('icon_theater', 'theme_compecer'),
        'film'               => get_string('icon_film', 'theme_compecer'),
        'camera'             => get_string('icon_camera', 'theme_compecer'),
        
        // Iconos de deporte y salud
        'running'            => get_string('icon_running', 'theme_compecer'),
        'swimming-pool'      => get_string('icon_swimming', 'theme_compecer'),
        'basketball-ball'    => get_string('icon_basketball', 'theme_compecer'),
        'football-ball'      => get_string('icon_football', 'theme_compecer'),
        'heartbeat'          => get_string('icon_heartbeat', 'theme_compecer'),
        'medkit'             => get_string('icon_medkit', 'theme_compecer'),
        
        // Iconos de navegación y ubicación
        'compass'            => get_string('icon_compass', 'theme_compecer'),
        'map'                => get_string('icon_map', 'theme_compecer'),
        'map-marker-alt'     => get_string('icon_mapmarker', 'theme_compecer'),
        'directions'         => get_string('icon_directions', 'theme_compecer'),
        'location-arrow'     => get_string('icon_location', 'theme_compecer'),
        
        // Iconos de colaboración y comunidad
        'hands-helping'      => get_string('icon_handshelping', 'theme_compecer'),
        'handshake'          => get_string('icon_handshake', 'theme_compecer'),
        'user-friends'       => get_string('icon_userfriends', 'theme_compecer'),
        'user-plus'          => get_string('icon_userplus', 'theme_compecer'),
        'users-cog'          => get_string('icon_userscog', 'theme_compecer'),
        'people-carry'       => get_string('icon_peoplecarry', 'theme_compecer')
    ];

    // -------------------------------------------------------------------------
    // Creación de la estructura principal de pestañas.
    // -------------------------------------------------------------------------
    $settings = new theme_compecer_admin_settingspage_tabs('themesettingcompecer', get_string('configtitle', 'theme_compecer'));

    // =========================================================================
    // ============================ GENERAL TAB =================================
    // =========================================================================
    $page = new admin_settingpage('theme_compecer_general', get_string('generalsettings', 'theme_compecer'));

    // Definición de imágenes de ejemplo para textos descriptivos.
    $a = new stdClass();
    $a->example_banner   = (string) $OUTPUT->image_url('example_banner', 'theme_compecer');
    $a->cover_moove      = (string) $OUTPUT->image_url('cover_moove', 'theme');
    $a->example_cover1   = (string) $OUTPUT->image_url('login_bg', 'theme');
    $a->example_cover2   = (string) $OUTPUT->image_url('cover2', 'theme');
    $a->banner_compecer  = (string) $OUTPUT->image_url('banner_compecer', 'theme');

    // Información del tema.
    $name = 'theme_compecer/themeinfotext';
    $title = '';
    $description = get_string('themeinfotext', 'theme_compecer', $a);
    $setting = new admin_setting_heading($name, $title, $description);
    $page->add($setting);

    // Configuración del modo de aviso general.
    $name = 'theme_compecer/generalnoticemode';
    $title = get_string('generalnoticemode', 'theme_compecer');
    $description = get_string('generalnoticemodedesc', 'theme_compecer');
    $default = 'off';
    $choices = [
        'off'    => get_string('generalnoticemode_off', 'theme_compecer'),
        'info'   => get_string('generalnoticemode_info', 'theme_compecer'),
        'danger' => get_string('generalnoticemode_danger', 'theme_compecer')
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Contenido del aviso general.
    $name = 'theme_compecer/generalnotice';
    $title = get_string('generalnotice', 'theme_compecer');
    $description = get_string('generalnoticedesc', 'theme_compecer');
    $default = get_string('generalnoticedefault', 'theme_compecer');
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // =========================================================================
    // ====================== DASHBOARD CARDS TAB ===============================
    // =========================================================================
    $page = new admin_settingpage('theme_compecer_mydashboard', get_string('mydashboardsettings', 'theme_compecer'));

    // Activación de las tarjetas del dashboard.
    $name = 'theme_compecer/enable_dashboard_cards';
    $title = get_string('enable_dashboard_cards', 'theme_compecer');
    $description = get_string('enable_dashboard_cardsdesc', 'theme_compecer');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Configuración por defecto de las tarjetas.
    $default_cards = [
        1 => [
            'title'    => 'Mensajes',
            'subtitle' => 'Comunicar',
            'url'      => $CFG->wwwroot . '/message/index.php',
            'color'    => '#2441e7',
            'icon'     => 'message'
        ],
        2 => [
            'title'    => 'Perfil',
            'subtitle' => 'Tu perfil',
            'url'      => $CFG->wwwroot . '/user/profile.php',
            'color'    => '#ff1053',
            'icon'     => 'user'
        ],
        3 => [
            'title'    => 'Configuración',
            'subtitle' => 'Preferencias',
            'url'      => $CFG->wwwroot . '/user/preferences.php',
            'color'    => '#00a78e',
            'icon'     => 'cog'
        ],
        4 => [
            'title'    => 'Calificaciones',
            'subtitle' => 'Rendimiento',
            'url'      => $CFG->wwwroot . '/grade/report/overview/index.php',
            'color'    => '#ecd06f',
            'icon'     => 'chart-bar'
        ]
    ];

    for ($i = 1; $i <= 4; $i++) {
        $card = $default_cards[$i];

        // Encabezado para la tarjeta.
        $page->add(new admin_setting_heading(
            "theme_compecer/dashboard_card_{$i}_heading",
            get_string('dashboard_card_heading', 'theme_compecer', $i),
            ''
        ));

        // Visibilidad de la tarjeta.
        $name = "theme_compecer/dashboard_card_{$i}_visibility";
        $title = get_string('dashboard_card_visibility', 'theme_compecer', $i);
        $description = get_string('dashboard_card_visibilitydesc', 'theme_compecer', $i);
        $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        // Título de la tarjeta.
        $name = "theme_compecer/dashboard_card_{$i}_title";
        $title = get_string('dashboard_card_title', 'theme_compecer', $i);
        $description = get_string('dashboard_card_titledesc', 'theme_compecer', $i);
        $setting = new admin_setting_configtext($name, $title, $description, $card['title']);
        $page->add($setting);

        // Subtítulo de la tarjeta.
        $name = "theme_compecer/dashboard_card_{$i}_subtitle";
        $title = get_string('dashboard_card_subtitle', 'theme_compecer', $i);
        $description = get_string('dashboard_card_subtitledesc', 'theme_compecer', $i);
        $setting = new admin_setting_configtext($name, $title, $description, $card['subtitle']);
        $page->add($setting);

        // URL de la tarjeta.
        $name = "theme_compecer/dashboard_card_{$i}_url";
        $title = get_string('dashboard_card_url', 'theme_compecer', $i);
        $description = get_string('dashboard_card_urldesc', 'theme_compecer', $i);
        $setting = new admin_setting_configtext($name, $title, $description, $card['url']);
        $page->add($setting);

        // Color de la tarjeta.
        $name = "theme_compecer/dashboard_card_{$i}_color";
        $title = get_string('dashboard_card_color', 'theme_compecer', $i);
        $description = get_string('dashboard_card_colordesc', 'theme_compecer', $i);
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $card['color']);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        // Ícono de la tarjeta.
        $name = "theme_compecer/dashboard_card_{$i}_icon";
        $title = get_string('dashboard_card_icon', 'theme_compecer', $i);
        $description = get_string('dashboard_card_icondesc', 'theme_compecer', $i);
        $setting = new admin_setting_configselect($name, $title, $description, $card['icon'], $icons);
        $page->add($setting);
    }

    $settings->add_tab($page);

    // =========================================================================
    // ============================== LOGIN TAB =================================
    // =========================================================================
    $page = new admin_settingpage('theme_compecer_login', get_string('loginsettings', 'theme_compecer'));

    $name = 'theme_compecer/loginbg_image';
    $title = get_string('loginbg_image', 'theme_compecer');
    $description = get_string('loginbg_imagedesc', 'theme_compecer', $a);
    $opts = ['subdirs' => 0, 'accepted_types' => ['web_image']];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbg_image', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_compecer/loginbg_color';
    $title = get_string('loginbg_color', 'theme_compecer');
    $description = get_string('loginbg_colordesc', 'theme_compecer');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#b2cdea');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // =========================================================================
    // ============================== SLIDER TAB ===============================
    // =========================================================================
    $page = new admin_settingpage('theme_compecer_slider', get_string('slidersettings', 'theme_compecer'));

    // Activación del slider.
    $name = 'theme_compecer/enable_slider';
    $title = get_string('enable_slider', 'theme_compecer');
    $description = get_string('enable_sliderdesc', 'theme_compecer');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Número de slides.
    $name = 'theme_compecer/slidercount';
    $title = get_string('slidercount', 'theme_compecer');
    $description = get_string('slidercountdesc', 'theme_compecer');
    $choices = [1 => '1', 2 => '2', 3 => '3'];
    $setting = new admin_setting_configselect($name, $title, $description, 1, $choices);
    $page->add($setting);

// Configuración de cada slide.
for ($i = 1; $i <= 3; $i++) {
    // Imagen del slider (desktop).
    $name = "theme_compecer/sliderimage{$i}";
    $title = get_string('sliderimage', 'theme_compecer', $i);
    $description = get_string('sliderimagedesc', 'theme_compecer') . ' (Desktop)';
    $opts = ['subdirs' => 0, 'accepted_types' => ['web_image']];
    $setting = new admin_setting_configstoredfile($name, $title, $description, "sliderimage{$i}", 0, $opts);
    $page->add($setting);

    // Imagen del slider (mobile).
    $name = "theme_compecer/sliderimage{$i}_mobile";
    $title = get_string('sliderimage', 'theme_compecer', $i) . ' (Mobile)';
    $description = get_string('sliderimagedesc', 'theme_compecer') . ' (Mobile)';
    $setting = new admin_setting_configstoredfile($name, $title, $description, "sliderimage{$i}_mobile", 0, $opts);
    $page->add($setting);
}

$settings->add_tab($page);

// =========================================================================
// ============================== ABOUT TAB ================================
// =========================================================================
$page = new admin_settingpage('theme_compecer_about', get_string('aboutsettings', 'theme_compecer'));

// Activación de la sección About.
$name = 'theme_compecer/enable_about';
$title = get_string('enable_about', 'theme_compecer');
$description = get_string('enable_aboutdesc', 'theme_compecer');
$setting = new admin_setting_configcheckbox($name, $title, $description, 1);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Título de la sección About.
$name = 'theme_compecer/abouttitle';
$title = get_string('abouttitle', 'theme_compecer');
$description = get_string('abouttitledesc', 'theme_compecer');
$default = get_string('abouttitledefault', 'theme_compecer');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// Contenido de la sección About.
$name = 'theme_compecer/aboutcontent';
$title = get_string('aboutcontent', 'theme_compecer');
$description = get_string('aboutcontentdesc', 'theme_compecer');
$default = get_string('aboutcontentdefault', 'theme_compecer');
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$page->add($setting);

$settings->add_tab($page);

// =========================================================================
// ============================== CAREER TAB ===============================
// =========================================================================
$page = new admin_settingpage('theme_compecer_career', get_string('careersettings', 'theme_compecer'));

// Activación de career boxes.
$name = 'theme_compecer/enablecareerboxes';
$title = get_string('enablecareerboxes', 'theme_compecer');
$description = get_string('enablecareerboxesdesc', 'theme_compecer');
$setting = new admin_setting_configcheckbox($name, $title, $description, 1);
$page->add($setting);

// Número de career boxes a mostrar
$name = 'theme_compecer/careerboxcount';
$title = get_string('careerboxcount', 'theme_compecer');
$description = get_string('careerboxcountdesc', 'theme_compecer');
$default = 3;
$choices = [
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5',
    6 => '6'
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

// Color de fondo para las career boxes.
$name = 'theme_compecer/careerboxesbgcolor';
$title = get_string('careerboxesbgcolor', 'theme_compecer');
$description = get_string('careerboxesbgcolordesc', 'theme_compecer');
$setting = new admin_setting_configcolourpicker($name, $title, $description, '#365ba3');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Configuración para cada career box (máximo 6)
$maxboxes = 6;
for ($i = 1; $i <= $maxboxes; $i++) {
    // Ícono de la career box
    $name = "theme_compecer/careerbox{$i}icon";
    $title = get_string('careerboxicon', 'theme_compecer', $i);
    $description = get_string('careerboxicondesc', 'theme_compecer');
    $default = 'graduation-cap';
    $setting = new admin_setting_configselect($name, $title, $description, $default, $icons);
    $page->add($setting);

    // Título de la career box
    $name = "theme_compecer/careerbox{$i}title";
    $title = get_string('careerboxtitle', 'theme_compecer', $i);
    $description = get_string('careerboxtitledesc', 'theme_compecer');
    $default = get_string('careerboxtitledefault', 'theme_compecer', $i);
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    // Contenido de la career box
    $name = "theme_compecer/careerbox{$i}content";
    $title = get_string('careerboxcontent', 'theme_compecer', $i);
    $description = get_string('careerboxcontentdesc', 'theme_compecer');
    $default = get_string('careerboxcontentdefault', 'theme_compecer', $i);
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);
}

$settings->add_tab($page);

// =========================================================================
// ============================== CHAT TAB ================================
// =========================================================================
$page = new admin_settingpage('theme_compecer_chat', get_string('chatsettings', 'theme_compecer'));

// Activación del chat.
$name = 'theme_compecer/enable_chat';
$title = get_string('enable_chat', 'theme_compecer');
$description = get_string('enable_chatdesc', 'theme_compecer');
$setting = new admin_setting_configcheckbox($name, $title, $description, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// URL de inserción del chat
$name = 'theme_compecer/tawkto_embed_url';
$title = get_string('tawkto_embed_url', 'theme_compecer');
$description = get_string('tawkto_embed_urldesc', 'theme_compecer');
$default = get_string('tawkto_embed_urldefault', 'theme_compecer');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$settings->add_tab($page);

// =========================================================================
// =========================== ACCESSIBILITY TAB ===========================
// =========================================================================
$page = new admin_settingpage('theme_compecer_accessibility', get_string('accessibilitysettings', 'theme_compecer'));

// Widget de accesibilidad.
$name = 'theme_compecer/accessibility_widget';
$title = get_string('accessibility_widget', 'theme_compecer');
$description = get_string('accessibility_widgetdesc', 'theme_compecer');
$setting = new admin_setting_configcheckbox($name, $title, $description, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$settings->add_tab($page);

// =========================================================================
// =========================== COPY/PASTE TAB ================================
// =========================================================================
$page = new admin_settingpage('theme_compecer_copypaste', get_string('copypastesettings', 'theme_compecer'));

// Prevención de copiado/pegado.
$name = 'theme_compecer/copypaste_prevention';
$title = get_string('copypaste_prevention', 'theme_compecer');
$description = get_string('copypaste_preventiondesc', 'theme_compecer');
$setting = new admin_setting_configcheckbox($name, $title, $description, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Selección de roles para la prevención.
require_once($CFG->libdir . '/accesslib.php');
$roles = role_get_names(null, ROLENAME_ORIGINAL);
$roles_array = [];
foreach ($roles as $role) {
    $roles_array[$role->id] = $role->localname;
}
$name = 'theme_compecer/copypaste_roles';
$title = get_string('copypaste_roles', 'theme_compecer');
$description = get_string('copypaste_rolesdesc', 'theme_compecer');
$setting = new admin_setting_configmultiselect($name, $title, $description, [5], $roles_array);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$settings->add_tab($page);

// =========================================================================
// =========================== CATEGORIES TAB ================================
// =========================================================================
$page = new admin_settingpage('theme_compecer_categories', get_string('categoriessettings', 'theme_compecer'));

// Activación de la búsqueda por categorías.
$name = 'theme_compecer/enable_search_categories';
$title = get_string('enable_search_categories', 'theme_compecer');
$description = get_string('enable_search_categoriesdesc', 'theme_compecer');
$setting = new admin_setting_configcheckbox($name, $title, $description, 1);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Selección de categorías.
$name = 'theme_compecer/selectedcategories';
$title = get_string('selectedcategories', 'theme_compecer');
$description = get_string('selectedcategoriesdesc', 'theme_compecer');
$categories = core_course_category::make_categories_list();
$setting = new admin_setting_configmultiselect($name, $title, $description, [], $categories);
$page->add($setting);

// Título de la sección de búsqueda.
$name = 'theme_compecer/searchsectiontitle';
$title = get_string('searchsectiontitle', 'theme_compecer');
$description = get_string('searchsectiontitledesc', 'theme_compecer');
$default = get_string('searchsectiontitledefault', 'theme_compecer');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$page->add($setting);

// Descripción de la sección de búsqueda.
$name = 'theme_compecer/searchsectiondesc';
$title = get_string('searchsectiondesc', 'theme_compecer');
$description = get_string('searchsectiondescdesc', 'theme_compecer');
$default = get_string('searchsectiondescdefault', 'theme_compecer');
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$page->add($setting);

// Color de fondo para las categorías.
$name = 'theme_compecer/categoriesbgcolor';
$title = get_string('categoriesbgcolor', 'theme_compecer');
$description = get_string('categoriesbgcolordesc', 'theme_compecer');
$setting = new admin_setting_configcolourpicker($name, $title, $description, '#f8f9fa');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$settings->add_tab($page);
}