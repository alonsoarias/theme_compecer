<?php
defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/classes/admin_settingspage_tabs.php');

if ($ADMIN->fulltree) {
    $settings = new theme_compecer_admin_settingspage_tabs('themesettingcompecer', get_string('configtitle', 'theme_compecer'));

    // General Settings Tab
    $page = new admin_settingpage('theme_compecer_general', get_string('generalsettings', 'theme_compecer'));

    // Dynamic strings
    $a = new stdClass;
    $a->example_banner = (string) $OUTPUT->image_url('example_banner', 'theme_compecer');
    $a->cover_moove = (string) $OUTPUT->image_url('cover_moove', 'theme');
    $a->example_cover1 = (string) $OUTPUT->image_url('login_bg', 'theme');
    $a->example_cover2 = (string) $OUTPUT->image_url('cover2', 'theme');
    $a->banner_compecer = (string) $OUTPUT->image_url('banner_compecer', 'theme');

    // Theme Info
    $name = 'theme_compecer/themeinfotext';
    $title = '';
    $description = get_string('themeinfotext', 'theme_compecer', $a);
    $setting = new admin_setting_heading($name, $title, $description);
    $page->add($setting);

    // Notice Settings
    $name = 'theme_compecer/generalnoticemode';
    $title = get_string('generalnoticemode', 'theme_compecer');
    $description = get_string('generalnoticemodedesc', 'theme_compecer');
    $default = 'off';
    $choices = [
        'off' => get_string('generalnoticemode_off', 'theme_compecer'),
        'info' => get_string('generalnoticemode_info', 'theme_compecer'),
        'danger' => get_string('generalnoticemode_danger', 'theme_compecer')
    ];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_compecer/generalnotice';
    $title = get_string('generalnotice', 'theme_compecer');
    $description = get_string('generalnoticedesc', 'theme_compecer');
    $default = '<strong>Estamos trabajando</strong> para mejorar. Es posible que por momentos la plataforma experimente comportamientos extraños.';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // Slider Settings Tab
    $page = new admin_settingpage('theme_compecer_slider', get_string('slidersettings', 'theme_compecer'));

    $name = 'theme_compecer/slidercount';
    $title = get_string('slidercount', 'theme_compecer');
    $description = get_string('slidercountdesc', 'theme_compecer');
    $default = 1;
    $choices = array(
        1 => '1',
        2 => '2',
        3 => '3'
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    for ($i = 1; $i <= 3; $i++) {
        // Desktop slider image
        $name = "theme_compecer/sliderimage{$i}";
        $title = get_string('sliderimage', 'theme_compecer', $i);
        $description = get_string('sliderimagedesc', 'theme_compecer') . ' (Desktop)';
        $opts = array('subdirs' => 0, 'accepted_types' => array('web_image'));
        $setting = new admin_setting_configstoredfile($name, $title, $description, "sliderimage{$i}", 0, $opts);
        $page->add($setting);

        // Mobile slider image
        $name = "theme_compecer/sliderimage{$i}_mobile";
        $title = get_string('sliderimage', 'theme_compecer', $i) . ' (Mobile)';
        $description = get_string('sliderimagedesc', 'theme_compecer') . ' (Mobile)';
        $opts = array('subdirs' => 0, 'accepted_types' => array('web_image'));
        $setting = new admin_setting_configstoredfile($name, $title, $description, "sliderimage{$i}_mobile", 0, $opts);
        $page->add($setting);

        // Slider title
        $name = "theme_compecer/slidertitle{$i}";
        $title = get_string('slidertitle', 'theme_compecer', $i);
        $description = get_string('slidertitledesc', 'theme_compecer');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $page->add($setting);

        // Slider caption
        $name = "theme_compecer/slidercaption{$i}";
        $title = get_string('slidercaption', 'theme_compecer', $i);
        $description = get_string('slidercaptiondesc', 'theme_compecer');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    $settings->add_tab($page);

    // About Settings Tab
    $page = new admin_settingpage('theme_compecer_about', get_string('aboutsettings', 'theme_compecer'));

    $name = 'theme_compecer/abouttitle';
    $title = get_string('abouttitle', 'theme_compecer');
    $description = get_string('abouttitledesc', 'theme_compecer');
    $default = get_string('abouttitledefault', 'theme_compecer');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_compecer/aboutcontent';
    $title = get_string('aboutcontent', 'theme_compecer');
    $description = get_string('aboutcontentdesc', 'theme_compecer');
    $default = get_string('aboutcontentdefault', 'theme_compecer');
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);

    $settings->add_tab($page);

    // Career Settings Tab
    $page = new admin_settingpage('theme_compecer_career', get_string('careersettings', 'theme_compecer'));

    $name = 'theme_compecer/enablecareerboxes';
    $title = get_string('enablecareerboxes', 'theme_compecer');
    $description = get_string('enablecareerboxesdesc', 'theme_compecer');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Array de iconos disponibles
    $icons = [
        'graduation-cap' => get_string('icon_graduation', 'theme_compecer'),
        'book' => get_string('icon_book', 'theme_compecer'),
        'laptop' => get_string('icon_laptop', 'theme_compecer'),
        'users' => get_string('icon_users', 'theme_compecer'),
        'globe' => get_string('icon_globe', 'theme_compecer'),
        'lightbulb' => get_string('icon_lightbulb', 'theme_compecer'),
        'chart-line' => get_string('icon_chart', 'theme_compecer'),
        'medal' => get_string('icon_medal', 'theme_compecer'),
        'certificate' => get_string('icon_certificate', 'theme_compecer'),
        'star' => get_string('icon_star', 'theme_compecer'),
        'rocket' => get_string('icon_rocket', 'theme_compecer'),
        'code' => get_string('icon_code', 'theme_compecer'),
        'microscope' => get_string('icon_microscope', 'theme_compecer'),
        'flask' => get_string('icon_flask', 'theme_compecer'),
        'atom' => get_string('icon_atom', 'theme_compecer'),
        'brain' => get_string('icon_brain', 'theme_compecer'),
        'university' => get_string('icon_university', 'theme_compecer'),
        'award' => get_string('icon_award', 'theme_compecer'),
        'user-graduate' => get_string('icon_usergraduate', 'theme_compecer'),
        'chalkboard-teacher' => get_string('icon_teacher', 'theme_compecer')
    ];

    for ($i = 1; $i <= 3; $i++) {
        // Box icon
        $name = "theme_compecer/careerbox{$i}icon";
        $title = get_string('careerboxicon', 'theme_compecer', $i);
        $description = get_string('careerboxicondesc', 'theme_compecer');
        $default = 'graduation-cap';
        $setting = new admin_setting_configselect($name, $title, $description, $default, $icons);
        $page->add($setting);

        // Box title
        $name = "theme_compecer/careerbox{$i}title";
        $title = get_string('careerboxtitle', 'theme_compecer', $i);
        $description = get_string('careerboxtitledesc', 'theme_compecer');
        $default = get_string('careerboxtitledefault', 'theme_compecer', $i);
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $page->add($setting);

        // Box content
        $name = "theme_compecer/careerbox{$i}content";
        $title = get_string('careerboxcontent', 'theme_compecer', $i);
        $description = get_string('careerboxcontentdesc', 'theme_compecer');
        $default = get_string('careerboxcontentdefault', 'theme_compecer', $i);
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    $settings->add_tab($page);

    // Chat Integration Tab
    $page = new admin_settingpage('theme_compecer_chat', get_string('chatsettings', 'theme_compecer'));

    $name = 'theme_compecer/enable_chat';
    $title = get_string('enable_chat', 'theme_compecer');
    $description = get_string('enable_chatdesc', 'theme_compecer');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_compecer/tawkto_embed_url';
    $title = get_string('tawkto_embed_url', 'theme_compecer');
    $description = get_string('tawkto_embed_urldesc', 'theme_compecer');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // Accessibility Tab
    $page = new admin_settingpage('theme_compecer_accessibility', get_string('accessibilitysettings', 'theme_compecer'));

    $name = 'theme_compecer/accessibility_widget';
    $title = get_string('accessibility_widget', 'theme_compecer');
    $description = get_string('accessibility_widgetdesc', 'theme_compecer');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // Copy/Paste Settings Tab
    $page = new admin_settingpage('theme_compecer_copypaste', get_string('copypastesettings', 'theme_compecer'));

    $name = 'theme_compecer/copypaste_prevention';
    $title = get_string('copypaste_prevention', 'theme_compecer');
    $description = get_string('copypaste_preventiondesc', 'theme_compecer');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    require_once($CFG->libdir . '/accesslib.php');
    $roles = role_get_names(null, ROLENAME_ORIGINAL);
    $roles_array = array();
    foreach ($roles as $role) {
        $roles_array[$role->id] = $role->localname;
    }

    $name = 'theme_compecer/copypaste_roles';
    $title = get_string('copypaste_roles', 'theme_compecer');
    $description = get_string('copypaste_rolesdesc', 'theme_compecer');
    $default = array(5); // Student role by default
    $setting = new admin_setting_configmultiselect($name, $title, $description, $default, $roles_array);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // Login Settings Tab
    $page = new admin_settingpage('theme_compecer_login', get_string('loginsettings', 'theme_compecer'));

    $name = 'theme_compecer/loginbg_image';
    $title = get_string('loginbg_image', 'theme_compecer');
    $description = get_string('loginbg_imagedesc', 'theme_compecer', $a);
    $opts = array('subdirs' => 0, 'accepted_types' => array('web_image'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbg_image', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_compecer/loginbg_color';
    $title = get_string('loginbg_color', 'theme_compecer');
    // Continuación del Login Settings Tab...
    $name = 'theme_compecer/loginbg_color';
    $title = get_string('loginbg_color', 'theme_compecer');
    $description = get_string('loginbg_colordesc', 'theme_compecer');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#b2cdea');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);

    // Nueva pestaña: Search and Categories Section Settings
    $page = new admin_settingpage('theme_compecer_categories', get_string('categoriessettings', 'theme_compecer'));

    // Enable Categories Display
    $name = 'theme_compecer/enablecategories';
    $title = get_string('enablecategories', 'theme_compecer');
    $description = get_string('enablecategoriesdesc', 'theme_compecer');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Selected Categories
    $name = 'theme_compecer/selectedcategories';
    $title = get_string('selectedcategories', 'theme_compecer');
    $description = get_string('selectedcategoriesdesc', 'theme_compecer');
    $categories = core_course_category::make_categories_list();
    $setting = new admin_setting_configmultiselect($name, $title, $description, [], $categories);
    $page->add($setting);

    // Search Section Title
    $name = 'theme_compecer/searchsectiontitle';
    $title = get_string('searchsectiontitle', 'theme_compecer');
    $description = get_string('searchsectiontitledesc', 'theme_compecer');
    $default = get_string('searchsectiontitledefault', 'theme_compecer');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    // Search Section Description
    $name = 'theme_compecer/searchsectiondesc';
    $title = get_string('searchsectiondesc', 'theme_compecer');
    $description = get_string('searchsectiondescdesc', 'theme_compecer');
    $default = get_string('searchsectiondescdefault', 'theme_compecer');
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);

    // Categories Section Background Color
    $name = 'theme_compecer/categoriesbgcolor';
    $title = get_string('categoriesbgcolor', 'theme_compecer');
    $description = get_string('categoriesbgcolordesc', 'theme_compecer');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#f8f9fa');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add_tab($page);
}