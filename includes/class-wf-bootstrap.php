<?php

namespace WF_Bootstrap;

use WF_Bootstrap\Button_Block_Type;

class WF_Bootstrap {
   public $assets_dir;
   public $assets_url;
   public $token = 'wf-bootstrap';

   public static $instance;

   public function __construct()
   {
      $this->define_constants();
      $this->includes();
      $this->init_plugin_environment();
      $this->init_hooks();
      $this->register_block_types();
   }

   protected function define_constants()
   {
      if ( ! defined( 'WF_BOOTSTRAP_ABSPATH' ) )
         define( 'WF_BOOTSTRAP_ABSPATH', trailingslashit( dirname( WF_BOOTSTRAP_PLUGIN_FILE ) ) );
   }
   
   public function init_plugin_environment()
   {
      $this->assets_dir = WF_BOOTSTRAP_ABSPATH . 'frontend/dist/';
      $this->assets_url = esc_url( trailingslashit( plugins_url( '/frontend/dist/', WF_BOOTSTRAP_PLUGIN_FILE ) ) );
   }

   public function register_block_types() {
      new Button_Block_Type();
   }

   public function includes()
   {
      require_once WF_BOOTSTRAP_ABSPATH . 'block-type.php';
      require_once WF_BOOTSTRAP_ABSPATH . 'button-block-type.php';
   }

   public function init_hooks()
   {
      add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ), 99 );
      add_filter( 'block_categories', array( $this, 'register_custom_block_category' ), 10, 2 );
   }

   public function register_custom_block_category( $categories, $post ) {
      return array_merge(
         $categories,
         array(
            array(
               'slug' => 'wf-bootstrap',
               'title' => __( 'Waterfall Bootstrap', 'wf-bootstrap' ),
            ),
         )
      );
   }
   
   public function enqueue_block_editor_assets() {
      $index_path = $this->assets_dir . 'index.build.js';
      $index_url = esc_url( $this->assets_url ) . 'index.build.js';
   
      $index_asset_file = $this->assets_dir . 'index.asset.php';
      $index_asset = file_exists( $index_asset_file )
         ? require_once $index_asset_file
         : null;
      $index_dependencies = isset( $index_asset['dependencies'] ) ? $index_asset['dependencies'] : array();
      $index_version = isset( $index_asset['version'] ) ? $index_asset['version'] : filemtime( $index_path );

      wp_enqueue_script(
         $this->token . '-js', // Handle.
         $index_url,
         $index_dependencies,
         $index_version,
         true // Enqueue the script in the footer.
      );
   }

   public static function get_instance() {
      if ( is_null( self::$instance ) ) {
         self::$instance = new self();
      }

      return self::$instance;
   }
}
