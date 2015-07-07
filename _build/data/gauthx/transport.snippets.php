<?php
/**
 * snippets transport file for GAuthx extra
 *
 * Copyright 2015 by Nick Clark 
 * Created on 07-05-2015
 *
 * @package gauthx
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'GAuthx',
  'description' => 'Creates a auth token in which can be used with the Google Authenticator app on your phone.',
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/gauthx.snippet.php'));


$properties = include $sources['data'].'properties/properties.gauthx.snippet.php';
$snippets[1]->setProperties($properties);
unset($properties);

$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->fromArray(array (
  'id' => 2,
  'property_preprocess' => false,
  'name' => 'GAuthxHook',
  'description' => 'PreHook snippet to be used with "Login" for front end 2 factor authentication',
), '', true, true);
$snippets[2]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/gauthxhook.snippet.php'));


$properties = include $sources['data'].'properties/properties.gauthxhook.snippet.php';
$snippets[2]->setProperties($properties);
unset($properties);

return $snippets;
