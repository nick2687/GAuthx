<?php
/**
 * GAuthx
 *
 * DESCRIPTION
 *
 * This snippet creates a random Auth Token for the logged in user and provides it to them as both a String
 * and as a QR CODE that can be scanned with your phone using Google Authenticator (or similar apps).
 * It will also display a input box so that you can confirm you have configured your Google Auth app is working correctly.
 * 
 * 
 * PROPERTIES:
 *
 * &tpl - Chunk Name - optional - Default: GAuthxTpl
 * &responseTpl - Chunk Name - optional - Default: GAuthxResponse
 *
 * USAGE:
 *
 * [[!GAuthx]]
 *
 */
 // Get user profile info & set default properties
$profile = $modx->user->getOne('Profile'); 
$profileCheck = $profile->get('extended');  
$pc = $profileCheck['userKey'];
$output = '';
$responseTpl = $modx->getOption('responseTpl', $scriptProperties, 'GAuthxResponse', true);
$tpl = $modx->getOption('tpl', $scriptProperties, 'GAuthxTpl', true);
     
if ($modx->user->get('id') != 0) {
    
        if (!$pc) {
          
            require_once 'core/components/gauthx/elements/vender/GoogleAuthenticator.php';
            $ga = new GoogleAuthenticator();     
            $account = urlencode($modx->getOption('site_name', null, 'Modx'));
             
            if (!$_GET['token']) {
               
                $secret = $ga->createSecret();
                $qrCodeUrl = $ga->getQRCodeGoogleUrl($account, $secret);
                $placeholders = array(
                    'secret' => $secret,
                    'qrCodeUrl' => $qrCodeUrl
                );    
                $output .= $modx->getChunk($tpl, $placeholders);
               
            }
            else {
                $token = $_GET['token'];
                $secret = $_GET['secret'];
                
                $checkResult = $ga->verifyCode($secret, $token, 2);    // 2 = 2*30sec clock tolerance
                if ($checkResult) {
                    $response = $modx->setPlaceholder('response', 'Success, You will now be required use 2FAx upon login.');
                
                    
                    $userKey = $profile->get('extended'); 
                    $userKey['userKey'] = $secret; 
                    $profile->set('extended',$userKey);  
                    $profile->save(); 
                $output .= $modx->getChunk($responseTpl, $placeholders);    
                } else {
                    
                    $qrCodeUrl = $ga->getQRCodeGoogleUrl($account, $secret);
                    $placeholders = array(
                        'secret' => $secret,
                        'qrCodeUrl' => $qrCodeUrl,
                        'response' => 'That token is incorrect, please try again'
                    );    
                    $output .= $modx->getChunk($tpl, $placeholders);
                }
                
            }
        }
        else {
            
            $response = $modx->setPlaceholder('response','You already have a GAuthx secret configured');
            $output .= $modx->getChunk($responseTpl, $placeholders);
            $modx->log(modX::LOG_LEVEL_ERROR, '[GAuthx] user already has a google authenticator secret configured');
        }
}
else {
    $response = $modx->setPlaceholder('response','You must be logged in to generate an Google Authenticator Token.'); 
    $output .= $modx->getChunk($responseTpl, $placeholders);
    $modx->log(modX::LOG_LEVEL_ERROR, '[GAuthx] requires user to be logged in to create a new token!');
}

return $output;