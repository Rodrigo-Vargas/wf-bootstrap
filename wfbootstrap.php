<?php
/**
 * Plugin Name: Waterfall Bootstrap
 * Plugin URI: 
 * Description: 
 * Version: 1.0.0
 * Author: Rodrigo Vargas
 * Author URI: http://rodrigovargas.com.br/waterfall-bootstrap-plugin
 * License:
 */

namespace WF_Bootstrap;

if ( ! defined( 'WF_BOOTSTRAP_PLUGIN_FILE' ) ) {
	define( 'WF_BOOTSTRAP_PLUGIN_FILE', __FILE__ );
}

require_once plugin_dir_path( WF_BOOTSTRAP_PLUGIN_FILE ) . 'includes/class-wf-bootstrap.php';

\WF_Bootstrap\WF_Bootstrap::get_instance();