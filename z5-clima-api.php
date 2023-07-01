<?php
/**
 * Plugin Name: Clima API
 * Plugin URI: https://zenx5.pro
 * Description: Clima para WordPress
 * Version: 1.0.0
 * Author: Octavio Martinez
 * Author URI: https://zenx5.pro
 * Text Domain: zenx5-clima
 * Domain Path: /i18n/languages/
 * Requires at least: 6.1
 * Requires PHP: 7.3
 *
 * @package Z5Clima
 */

include_once 'classes/class-z5-clima.php';

defined( 'ABSPATH' ) || exit;

register_activation_hook(__FILE__, ['Z5Clima','activation']);
register_deactivation_hook(__FILE__, ['Z5Clima','deactivation']);

add_action('init', ['Z5Clima','init']);