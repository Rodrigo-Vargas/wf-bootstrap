<?php

namespace WF_Bootstrap;

abstract class Block_Type {
   protected $name = '';

   protected $attributes = array();

   protected $default_attributes = array();

   public function __construct() {
      add_action( 'init', array( $this, 'register_block_type' ) );
   }

   public function register_block_type() {
      $this->default_attributes = apply_filters( "{$this->get_filter_prefix()}_default_attributes", $this->default_attributes );

      foreach ( $this->default_attributes as $attribute_name => $default_value ) {
         if ( array_key_exists( $attribute_name, $this->attributes ) ) {
            $this->attributes[ $attribute_name ]['default'] = $default_value;
         }
      }

      register_block_type(
         $this->name,
         array(
            'render_callback' => array( $this, 'render_callback' ),
            'attributes' => $this->attributes,
         )
      );
   }

   public function render_callback( $attributes, $content ) {
      return wp_bootstrap_blocks_get_template( $this->get_template_name(), $attributes, $content );
   }

   protected function get_filter_prefix() {
      return preg_replace( '/[-\/]/', '_', $this->name );
   }

   protected function get_template_name() {
      $namespace_separator_position = strrpos( $this->name, '/' );
      return false === $namespace_separator_position ? $this->name : substr( $this->name, $namespace_separator_position + 1 );
   }
}