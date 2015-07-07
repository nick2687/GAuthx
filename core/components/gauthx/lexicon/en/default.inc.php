<?php
/**
 * en default topic lexicon file for GAuthx extra
 *
 * Copyright 2015 by Nick Clark 
 * Created on 07-05-2015
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

/**
 * Description
 * -----------
 * en default topic lexicon strings
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package gauthx
 **/



/* Used in gauthxlogintpl.chunk.html */
$_lang['login.username'] = '';
$_lang['login.password'] = '';
$_lang['gauthx.token'] = 'Token';

/* Used in gauthx.snippet.php */
$_lang['gauthx_success'] = 'Success, You will now be required use 2FAx upon login.';
$_lang['gauthx_already'] = 'You already have a GAuthx secret configured';
$_lang['gauthx_notloggedin'] = 'You must be logged in to generate an Google Authenticator Token.';

/* Used in gauthxhook.snippet.php */
$_lang['gauthx_incorrect'] = 'The username or password you entered is incorrect. Please check the username, re-type the password, and try again.';
$_lang['gauthx_invalid'] = 'Invalid Token';