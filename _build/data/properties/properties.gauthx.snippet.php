<?php
/**
 * Properties file for GAuthx snippet
 *
 * Copyright 2015 by Nick Clark 
 * Created on 07-05-2015
 *
 * @package gauthx
 * @subpackage build
 */




$properties = array (
  'responseTpl' => 
  array (
    'name' => 'responseTpl',
    'desc' => 'Response Tpl for returning messages to the user (success, failure, errors, etc)',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => 'GAuthxResponse',
    'lexicon' => NULL,
    'area' => '',
  ),
  'tpl' => 
  array (
    'name' => 'tpl',
    'desc' => 'Default GAuthx chunk for displaying the auth secret and qr code.

Placeholders include qrCodeUrl, secret & response',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => 'GAuthxTpl',
    'lexicon' => NULL,
    'area' => '',
  ),
);

return $properties;

