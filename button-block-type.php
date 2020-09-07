<?php

namespace WF_Bootstrap;

use WF_Bootstrap\Block_Type;

class Button_Block_Type extends Block_Type {
   protected $name = 'wf-bootstrap/button';

   protected $attributes = array(
      'url' => array(
         'type' => 'string',
      ),
      'text' => array(
         'type' => 'string',
      ),
      'style' => array(
         'type' => 'string',
      ),
      'alignment' => array(
         'type' => 'string',
      ),
   );

   protected $default_attributes = array(
      'url' => '',
      'text' => '',
      'style' => '',
      'alignment' => '',
   );
}