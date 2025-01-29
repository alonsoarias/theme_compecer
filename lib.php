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
 * Theme functions.
 *
 * @package    theme_compecer
 * @copyright  2024 IngeWeb https://www.ingeweb.co
 * @author     Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../moove/lib.php');

function theme_compecer_get_course_image($corecourselistelement, $islist = false) {
    global $CFG, $OUTPUT;
    if (!$islist && $corecourselistelement instanceof stdClass) {
        $corecourselistelement = new \core_course_list_element($corecourselistelement);
    }
    if (method_exists($corecourselistelement, 'get_course_overviewfiles')) {
        // Course image.
        foreach ($corecourselistelement->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $courseimage = file_encode_url(
                "$CFG->wwwroot/pluginfile.php",
                '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                $file->get_filearea(). $file->get_filepath(). $file->get_filename(),
                !$isimage
            );
            if ($isimage) {
                return $courseimage;
            }
        }
    }
    // Return a generated SVG image if no image is found.
    return $OUTPUT->get_generated_image_for_id($corecourselistelement->id);
}

function theme_compecer_get_extra_scss($theme) {
    $parent_theme = theme_config::load('moove');
    $scss = theme_moove_get_extra_scss($parent_theme);

    //Extra SCSS if needed..
    $scss .= theme_compecer_set_extra_img($theme);

    return $scss;
}

function theme_compecer_get_pre_scss($theme) {
    $scss = theme_moove_get_extra_scss($theme);

    return $scss;
}

function theme_compecer_get_main_scss_content($theme) {
    global $CFG;

    // compecer scss.
    $compecer_variables = file_get_contents($CFG->dirroot . '/theme/compecer/scss/_variables.scss');
    $custom_variables = file_get_contents($CFG->dirroot . '/theme/compecer/scss/custom_variables.scss');
    $compecer = file_get_contents($CFG->dirroot . '/theme/compecer/scss/compecer.scss');
    $custom = file_get_contents($CFG->dirroot . '/theme/compecer/style/custom.css');

    // Combine them with moove.
    return $compecer_variables . "\n" . $custom_variables . "\n" . theme_moove_get_main_scss_content($theme) . "\n" . $compecer . "\n" . $custom;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_moove', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_moove and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    // Moove scss.
    $moovevariables = file_get_contents($CFG->dirroot . '/theme/moove/scss/moove/_variables.scss');
    $moove = file_get_contents($CFG->dirroot . '/theme/moove/scss/moove.scss');

    // Combine them together.
    return $moovevariables . "\n" . $compecer_variables . "\n" . $custom_variables . "\n" . $scss . "\n" . $moove . "\n" . $compecer . "\n" . $custom;
}

function theme_compecer_set_extra_img($theme) {
    global $OUTPUT;

    $css = '';
    $topfooterimg = $theme->setting_file_url('topfooterimg', 'topfooterimg');

    if (is_null($topfooterimg)) {
        $css =  "#top-footer {background-image: none;}";
    } else {
        $css = "#top-footer {background-image: url('$topfooterimg');}";
    }

    $content = '';

    // Sets the login background image.
    $loginbg_image = $theme->setting_file_url('loginbg_image', 'loginbg_image');
    if (!empty($loginbg_image)) {
        $content .= 'body.pagelayout-login #page { ';
        $content .= "background-image: url('$loginbg_image'); background-size: cover;";
        $content .= ' }';
    }

    // Always return the background image with the scss when we have it.
    return !empty($theme->settings->scss) ? $theme->settings->scss . ' ' . $content : $content;
    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return mixed
 */
function theme_compecer_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    $theme = theme_config::load('compecer');

    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $validfileareas = [
            'loginbg_image',
            'sliderimage1',
            'sliderimage2',
            'sliderimage3',
            'topfooterimg'
        ];
        
        if (in_array($filearea, $validfileareas)) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        }
    }

    return theme_moove_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, $options);
}

/**
 * Get theme setting
 *
 * @param string $setting
 * @param bool $format
 * @return string
 */
function theme_compecer_get_setting($setting, $format = false) {
    $theme = theme_config::load('compecer');

    if (empty($theme->settings->$setting)) {
        return false;
    }

    if (!$format) {
        return $theme->settings->$setting;
    }

    if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    }

    if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    }

    return format_string($theme->settings->$setting);
}