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
 * Core renderer file.
 *
 * @package    theme_compecer
 * @copyright  2024 IngeWeb https://www.ingeweb.co
 * @author     Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_compecer\output;

use html_writer;
use custom_menu;
use action_menu_filler;
use action_menu_link_secondary;
use stdClass;
use moodle_url;
use action_menu;
use pix_icon;
use theme_config;
use core_text;
use help_icon;
use context_system;
use core_course_list_element;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../../../moove/classes/output/core_renderer.php');
require_once(__DIR__ . '/../util/theme_settings.php');

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 */
class core_renderer extends \theme_moove\output\core_renderer {

    /**
     * Renders the login form.
     *
     * @param \core_auth\output\login $form The renderable.
     * @return string
     */
    public function render_login(\core_auth\output\login $form) {
        global $SITE, $CFG;

        $context = $form->export_for_template($this);

        $theme = theme_config::load('compecer');

        // Override because rendering is not supported in template yet.
        $context->cookieshelpiconformatted = $this->help_icon('cookiesenabled');
        $context->errorformatted = $this->error_text($context->error);

        $context->logourl = $this->get_logo();
        $context->sitename = format_string($SITE->fullname, true, array('context' => \context_course::instance(SITEID)));
        $context->my_credit = get_string('credit', 'theme_compecer');

        // Manejar la imagen de fondo o el color para la página de login
        $loginbgimageurl = $theme->setting_file_url('loginbg_image', 'loginbg_image');
        if (!empty($loginbgimageurl)) {
            $context->loginbg_imageurl = $loginbgimageurl;
            $context->loginbackground = "background-image: url('{$loginbgimageurl}'); background-size: cover;";
        } else {
            $loginbgcolor = $theme->settings->loginbg_color ?? '#b2cdea';
            $context->loginbackground = "background-color: {$loginbgcolor};";
        }

        if (file_exists(__DIR__ . "/../../templates/core/login-custom.mustache")) {
            return $this->render_from_template('core/login-custom', $context);
        }

        return $this->render_from_template('core/login', $context);
    }

    /**
     * Get theme image URL.
     *
     * @return string
     */
    public function get_theme_img_url($img) {
        $theme = theme_config::load('compecer');
        return $theme->setting_file_url($img, $img);
    }

    /**
     * Returns standard footer content.
     *
     * @return string HTML footer content
     */
    public function standard_footer_html() {
        global $CFG, $USER;

        $output = parent::standard_footer_html();

        // Add chat widget if enabled
        if (!empty($this->page->theme->settings->enable_chat)) {
            $output .= $this->add_chat_widget();
        }

        // Add accessibility widget if enabled
        if (!empty($this->page->theme->settings->accessibility_widget)) {
            $output .= '<script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>';
        }

        // Add copy paste prevention if enabled
        if (!empty($this->page->theme->settings->copypaste_prevention)) {
            $this->add_copy_paste_prevention();
        }

        // Check if about text should be hidden
        if (!empty($theme->settings->hideabouttext)) {
            $output .= '<style>section#top-footer { display: none !important; }</style>';
        }

        return $output;
    }

/**
 * Returns full header.
 *
 * @return string HTML for header
 */
public function full_header() {
    global $CFG, $USER, $PAGE, $COURSE;

    if ($USER->id != 2) {
        $CFG->perfdebug = 0;
    }

    $theme = theme_config::load('compecer');
    
    // Preparar el contexto para la plantilla
    $header = new stdClass();
    
    // Manejar las notificaciones
    $header->hasnotice = false;
    $header->notice = '';
    $header->noticeclass = '';
    $header->noticeicon = '';
    
    if (!empty(trim($theme->settings->generalnotice))) {
        $header->hasnotice = true;
        $header->notice = $theme->settings->generalnotice;
        
        if ($theme->settings->generalnoticemode == 'info') {
            $header->noticeclass = 'alert-info';
            $header->noticeicon = 'fa-info-circle';
        } else if ($theme->settings->generalnoticemode == 'danger') {
            $header->noticeclass = 'alert-danger';
            $header->noticeicon = 'fa-warning';
        }
    } else if (is_siteadmin() && $theme->settings->generalnoticemode == 'off') {
        $header->hasnotice = true;
        $header->notice = get_string('generalnotice_create', 'theme_compecer');
        $header->noticeclass = 'alert-light';
        $header->noticeicon = 'fa-edit';
        $header->isadminnotice = true;
        $header->settingsurl = $CFG->wwwroot . '/admin/settings.php?section=themesettingcompecer#theme_compecer';
    }
    
    // Obtener imagen del curso
    $header->courseimageurl = '';
    if ($PAGE->course && $PAGE->course->id > 1) {
        require_once($CFG->dirroot . '/theme/compecer/lib.php');
        $header->courseimageurl = theme_compecer_get_course_image($PAGE->course);
    }
    
    // Agregar información del contexto
    $header->contextheader = $this->context_header();
    $header->pageheadingbutton = $this->page_heading_button();
    $header->courseheader = $this->course_header();
    
    if ($this->page->navbar) {
        $header->hasnavbar = true;
        $header->navbar = $this->navbar();
    }

    $header->headeractions = $this->page->get_header_actions();
    
    return $this->render_from_template('theme_compecer/core/full_header', $header);
}

    /**
     * Adds chat widget if enabled.
     *
     * @return string Chat widget HTML
     */
    protected function add_chat_widget() {
        global $USER;
        if (!isloggedin() || empty($this->page->theme->settings->tawkto_embed_url)) {
            return '';
        }

        return "<!--Start of Chat Script-->
        <script type=\"text/javascript\">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        Tawk_API.visitor = {
            name  : '" . $USER->firstname . " " . $USER->lastname . "',
            email : '" . $USER->email . "',
            username : '" . $USER->username . "',
            idnumber : '" . $USER->idnumber . "'
        };
        Tawk_API.onLoad = function(){
            Tawk_API.setAttributes({
                name  : '" . $USER->firstname . " " . $USER->lastname . "',
                email : '" . $USER->email . "',
                username : '" . $USER->username . "',
                idnumber : '" . $USER->idnumber . "'
            }, function(error){});
        };
        (function(){
            var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];
            s1.async=true;
            s1.src='" . $this->page->theme->settings->tawkto_embed_url . "';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Chat Script-->";
    }

    /**
     * Adds copy/paste prevention JavaScript for specified roles.
     */
    protected function add_copy_paste_prevention() {
        global $USER, $PAGE, $COURSE;

        // Get restricted roles from theme settings
        $restricted_roles = $this->page->theme->settings->copypaste_roles;

        // If no roles are restricted or settings is empty, return
        if (empty($restricted_roles)) {
            return;
        }

        // If user is site admin, no restrictions apply
        if (is_siteadmin()) {
            return;
        }

        try {
            // Get course context
            $context = null;

            // Check if we are in a course context
            if (!empty($COURSE->id) && $COURSE->id > 1) {
                $context = \context_course::instance($COURSE->id);
            } else if (!empty($PAGE->context)) {
                // If not in a course, try to get context from page
                $context = $PAGE->context;
            }

            if (!$context) {
                return; // No valid context found
            }

            // Convert to array if it's a string
            if (!is_array($restricted_roles)) {
                $restricted_roles = explode(',', $restricted_roles);
            }

            // Check if user has any restricted role in this context
            $has_restricted_role = false;
            $user_roles = get_user_roles($context, $USER->id);

            foreach ($user_roles as $role) {
                if (in_array($role->roleid, $restricted_roles)) {
                    $has_restricted_role = true;
                    break;
                }
            }

            // Only apply restrictions if user has restricted role and is logged in
            if (isloggedin() && $has_restricted_role) {
                $PAGE->requires->js_call_amd('theme_compecer/prevent_copy_paste', 'init');
            }
        } catch (moodle_exception $e) {
            debugging('Error in copy/paste prevention: ' . $e->getMessage(), DEBUG_DEVELOPER);
            return;
        }
    }
}