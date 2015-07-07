<?php
/**
 * Properties file for GAuthxHook snippet
 *
 * Copyright 2015 by Nick Clark 
 * Created on 07-05-2015
 *
 * @package gauthx
 * @subpackage build
 */




$properties = array (
  'historyLimit' => 
  array (
    'name' => 'historyLimit',
    'desc' => 'integer - optional - Default: 10 - Sets the number of provided tokens you wish to be remembered before a token could be used again',
    'type' => 'numberfield',
    'options' => 
    array (
    ),
    'value' => '10',
    'lexicon' => NULL,
    'area' => '',
  ),
  'tolerance' => 
  array (
    'name' => 'tolerance',
    'desc' => 'integer - optional - Default: 2 - Sets the amount of time / tolerance you wish the authenticator to allow a provided token to be valid for',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '2',
    'lexicon' => NULL,
    'area' => '',
  ),
);

return $properties;

