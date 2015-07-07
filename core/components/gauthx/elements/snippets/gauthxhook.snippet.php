<?php
/**
 * GAuthxHook
 *
 * DESCRIPTION
 *
 * This Snippet is to be useds as a PRE-Hook for  Shaun McCormick's snippet "Login" - it allows for you to add
 * 2 factor authentication (using google authenticator) to your member only areas in any front-end context
 * on your site
 *
 * PROPERTIES:
 *
 * &tolerance - integer - optional - Default: 2 - Sets the amount of time / tolerance you wish the authenticator to allow a provided token to be valid for
 * &historyLimit - integer - optional - Default: 10 - Sets the number of provided tokens you wish to be remembered before a token could be used again
 *
 * USAGE:
 *
 * [[!Login? &loginTpl=`GAuthxLoginTpl` &preHooks=`GAuthxHook` &tolerance=`3` &historyLimit=`5`]]
 *
 */
//Load GAuthx Package
$path = MODX_CORE_PATH . 'components/gauthx/';$result = $modx->addPackage('gauthx',$path . 'model/','gauthx_');

$tolerance = $modx->getOption('tolerance', $scriptProperties, 2);
$historyLimit = $modx->getOption('historyLimit', $scriptProperties, 10);


// Get Form Fields
$formFields = $hook->getValues(); $token = $formFields['token'];

// If user attempting to logout return true to allow logout
if ($_GET['service'] == 'logout') return true;

// If user has input a username proceed, if not return error
if ($formFields['username']) {
$modx->log(modX::LOG_LEVEL_ERROR, 'there is a username in the field');
    // Get user profile
    $user = $modx->getObject('modUser', array('username' => $formFields['username']));
    if (!$user) {
$modx->log(modX::LOG_LEVEL_ERROR, 'user does not exisit');
        // if the username entered doesn't exisit return error
        $errorMsg = 'The username or password you entered is incorrect. Please check the username, re-type the password, and try again.';
        $hook->addError('user',$errorMsg);
        return false;
    }
    
    // Get user id & profile
    $id = $user->get('id'); $profile = $user->getOne('Profile'); $userKeyCheck = $profile->get('extended'); 
    
    // Check if user is configured to use 2-Factor Auth
    $userKey = $userKeyCheck['userKey'];
    
    if ($userKey) {
$modx->log(modX::LOG_LEVEL_ERROR, 'user key exists');
        // If the user has a userKey setup continue - then check if the provided token has been used by this user previously
        $submitHistory = $modx->getObject('UserHistory',array('internalKey' => $id,'previousKey' => $token));
        if ($submitHistory) {$SHC = $submitHistory->get('id');} else {$SHC = 0;}
$modx->log(modX::LOG_LEVEL_ERROR, 'SHC =' . $SHC . '.');
        if ($SHC == 0) {
            // if user has not used the token before - continue - else return error
            
            require_once 'core/components/gauthx/elements/plugins/GoogleAuthenticator.php';
            $ga = new GoogleAuthenticator();
            
            // validate if code matches user token
            $checkResult = $ga->verifyCode($userKey, $token, $tolerance);    // 2 = 2*30sec clock tolerance
            
                // if yes add provided token to user history, clean up user history & allow user to login. - Else return error
            if ($checkResult) {
$modx->log(modX::LOG_LEVEL_ERROR, 'user checks out!');
                    
                $log = $modx->newObject('UserHistory');
                    $log->set('internalKey', $id);
                    $log->set('previousKey', $token);
                $log->save();
                
                // get count of user hisotry for user who is logging in
                $max = $modx->getCount('UserHistory',array('internalKey' => $id));
$modx->log(modX::LOG_LEVEL_ERROR, 'Max =' . $max . 'Limit =' . $historyLimit);                
                if ($max > $historyLimit) {
$modx->log(modX::LOG_LEVEL_ERROR, 'Oh no max is bigger!');                     
                    // if count is greater than history limit remove a row ()
                    
                    $newlimit = $max - $historyLimit;
                   
                    $query = $modx->newQuery('UserHistory'); 
                    $query->sortby('id','ASC');
                    $query->limit($newlimit);

                    $ls = $modx->getCollection('UserHistory',$query);
                    
                        foreach ($ls as $l) {

                           $l->remove();
                        }
                }
               
                return true;
            } else {
$modx->log(modX::LOG_LEVEL_ERROR, 'That Token is Invalid 1');
                $errorMsg = 'That Token is Invalid';
                $hook->addError('user',$errorMsg);
                return false;
            }
        }
        else {
$modx->log(modX::LOG_LEVEL_ERROR, 'That Token is Invalid 2');
            $errorMsg = 'That Token is Invalid';
            $hook->addError('user',$errorMsg);
            return false;
        }
        
    }
    else {
$modx->log(modX::LOG_LEVEL_ERROR, 'sall good');
        return true;
    }
}
else {
$modx->log(modX::LOG_LEVEL_ERROR, 'wrong username pass last');
    $errorMsg ='The username or password you entered is incorrect. Please check the username, re-type the password, and try again.';
    $hook->addError('user',$errorMsg);
    return false;
}