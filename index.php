<?php
/**
 * Plugin Name
 *
 * @package           LocalhostToIP
 * @author            Saif Islam
 * @copyright         2021 LocalhostToIP
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       localhost to IP
 * Plugin URI:        https://github.com/sopu175
 * Description:       This plugin change your site url and home url localhost to your ip or another url. You can share your localhost wordpress site via ip address or another url.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Saif Islam
 * Author URI:        https://github.com/sopu175
 * Text Domain:       ltp
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * {Plugin Name} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * {Plugin Name} is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with {Plugin Name}. If not, see {URI to Plugin License}.

 */

global $wpdb;
function localhosttoIP_activation_hook()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'options';
}

register_activation_hook(__FILE__, "localhosttoIP_activation_hook");


function localhosttoIP_deactivation_hook()
{
}

register_deactivation_hook(__FILE__, "localhosttoIP_deactivation_hook");


function localhosttoIP_load_textdomain()
{
    load_plugin_textdomain('ltp', false, dirname(__FILE__) . "/languages");
}

add_action("plugins_loaded", 'localhosttoIP_load_textdomain');


require_once plugin_dir_path(__FILE__) . "/form.php";

