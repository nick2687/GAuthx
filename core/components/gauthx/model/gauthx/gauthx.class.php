<?php
/**
 * GAuthx class file for GAuthx extra
 *
 * Copyright 2015 by Nick Clark 
 * Created on 07-06-2015
 *
 * GAuthx is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * GAuthx is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * GAuthx; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gauthx
 */


class GAuthx {
    /** @var $modx modX */
    public $modx;
    /** @var $props array */
    public $config;

    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
        $corePath = $modx->getOption('gauthx.core_path',null,
            $modx->getOption('core_path').'components/gauthx/');
        $assetsUrl = $modx->getOption('gauthx.assets_url',null,
            $modx->getOption('assets_url').'components/gauthx/');

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'chunksPath' => $corePath.'elements/chunks/',
            'modelPath' => $corePath.'model/',
            'processorsPath' => $corePath.'processors/',
            'templatesPath' => $corePath . 'templates/',

            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl.'css/',
            'jsUrl' => $assetsUrl.'js/',
        ),$config);

        $this->modx->addPackage('GAuthx',$this->config['modelPath']);
        if ($this->modx->lexicon) {
            $this->modx->lexicon->load('example:default');
        }
    }
}