<?php
/**
 * IngeWeb.
 *
 * @package    theme_compecer
 * @copyright  Creado por Ing Pablo A Pico - @pabloapico exclusivamente para plataformas Moodle creadas y soportadas por IngeWeb - Soluciones para triunfar en Internet
 */

defined('MOODLE_INTERNAL') || die();

class theme_compecer_admin_settingspage_tabs extends theme_boost_admin_settingspage_tabs {

    /**
     * Add a tab in the first position.
     *
     * @param admin_settingpage $tab A tab.
     */
    public function insert_tab(admin_settingpage $tab) {
        foreach ($tab->settings as $setting) {
            $this->settings->{$setting->name} = $setting;
        }
        array_unshift($this->tabs, $tab);
        return true;
    }

    /**
     * Set tabs.
     *
     * @return void
     */
    public function set_tabs($tabs, $reset = true) {
        if ($reset) $this->tabs = array();

        foreach ($tabs as $tab) {
            $tab->name = str_replace('theme_moove', 'theme_compecer', $tab->name);
            $this->add_tab($tab);
        }
    }

}

