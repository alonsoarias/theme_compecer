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
 * @copyright  2024 IngeWeb https://www.ingeweb.co
 * @author     Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require(__DIR__ . '/../moove/settings.php');
require_once(__DIR__ . '/classes/admin_settingspage_tabs.php');

if ($ADMIN->fulltree) {
    $tabs = $settings->get_tabs();
    $settings = new theme_compecer_admin_settingspage_tabs('themesettingcompecer', get_string('configtitle', 'theme_compecer'));
    $settings->set_tabs($tabs);

    $page = new admin_settingpage('theme_compecer', get_string('themesettings', 'theme_compecer'));

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

    // SECTION: General Settings
    $page->add(new admin_setting_heading(
        'theme_compecer_general',
        get_string('themesettingsgeneral', 'theme_compecer'),
        get_string('themesettingsgeneraldesc', 'theme_compecer')
    ));

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

    // SECTION: Chat Integration
    $page->add(new admin_setting_heading(
        'theme_compecer_chat',
        get_string('themesettingschat', 'theme_compecer'),
        get_string('themesettingschatdesc', 'theme_compecer')
    ));

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

    // SECTION: Accessibility
    $page->add(new admin_setting_heading(
        'theme_compecer_accessibility',
        get_string('themesettingsaccessibility', 'theme_compecer'),
        get_string('themesettingsaccessibilitydesc', 'theme_compecer')
    ));

    $name = 'theme_compecer/accessibility_widget';
    $title = get_string('accessibility_widget', 'theme_compecer');
    $description = get_string('accessibility_widgetdesc', 'theme_compecer');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // SECTION: Copy/Paste Settings
    $page->add(new admin_setting_heading(
        'theme_compecer_copypaste',
        get_string('themesettingscopypaste', 'theme_compecer'),
        get_string('themesettingscopypaste_desc', 'theme_compecer')
    ));

    $name = 'theme_compecer/copypaste_prevention';
    $title = get_string('copypaste_prevention', 'theme_compecer');
    $description = get_string('copypaste_preventiondesc', 'theme_compecer');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Get all roles for multiselect
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

    // SECTION: Login Settings
    $page->add(new admin_setting_heading(
        'theme_compecer_login',
        get_string('themesettingslogin', 'theme_compecer'),
        get_string('themesettingslogindesc', 'theme_compecer')
    ));

    $name = 'theme_compecer/loginbg_image';
    $title = get_string('loginbg_image', 'theme_compecer');
    $description = get_string('loginbg_imagedesc', 'theme_compecer', $a);
    $opts = array('subdirs' => 0, 'accepted_types' => 'web_image');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbg_image', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_compecer/loginbg_color';
    $title = get_string('loginbg_color', 'theme_compecer');
    $description = get_string('loginbg_colordesc', 'theme_compecer');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#b2cdea');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // About Settings Section
    $page->add(new admin_setting_heading(
        'theme_compecer_about',
        get_string('themesettingsabout', 'theme_compecer'),
        get_string('themesettingsaboutdesc', 'theme_compecer')
    ));

    // Toggle visibility of about text
    $name = 'theme_compecer/hideabouttext';
    $title = get_string('hideabouttext', 'theme_compecer');
    $description = get_string('hideabouttextdesc', 'theme_compecer');
    $default = 0;  // Default to showing the about text
    $choices = array(
        0 => get_string('show', 'theme_compecer'),
        1 => get_string('hide', 'theme_compecer')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // About text setting
    $name = 'theme_compecer/abouttext';
    $title = get_string('abouttext', 'theme_compecer');
    $description = get_string('abouttextdesc', 'theme_compecer');
    $default = '<p><strong>IngeWeb - Soluciones para triunfar en Internet</strong><br>Expertos en Moodle, BigBlueButton, Wordpress y Joomla.<br><strong>www.ingeweb.co</strong></p>';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->insert_tab($page);
}
