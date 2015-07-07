<?php

if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('gauthx.core_path',null,$modx->getOption('core_path').'components/gauthx/').'model/';
            $modx->addPackage('gauthx',$modelPath,'gauthx_');

            $manager = $modx->getManager();

            $manager->createObjectContainer('UserHistory');
           

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;