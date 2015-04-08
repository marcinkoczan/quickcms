<?php
/*
* Quick.Cms by OpenSolution.org
* www.OpenSolution.org
*/
extract( $_GET );
define( 'ADMIN_PAGE', true );
$_SERVER['REQUEST_URI'] = addslashes( htmlspecialchars( strip_tags( $_SERVER['REQUEST_URI'] ) ) );
$_SERVER['PHP_SELF'] = addslashes( htmlspecialchars( strip_tags( $_SERVER['PHP_SELF'] ) ) );


require 'database/config/general.php';
require DB_CONFIG_LANG;

if( isset( $config['allowed_ip_admin_panel'] ) && $config['allowed_ip_admin_panel'] != $_SERVER['REMOTE_ADDR'] ){
  header( 'Location: ./' );
  exit;
}
elseif( !empty( $p ) && ( $config['login'] == 'admin' || $config['pass'] == 'admin' ) && !preg_match( '/login|dasbhoard|logout|tools-config/', $p ) && $_SERVER['SERVER_ADDR'] != '127.0.0.1' && !strstr( $_SERVER['HTTP_HOST'], 'localhost' )  ){
  header( 'Location: '.$_SERVER['PHP_SELF'].'?p=tools-config&sOption=login-pass' );
  exit;  
}

session_start( );

header( 'Content-Type: text/html; charset='.$config['charset'] );
require_once DIR_LIBRARIES.'file-jobs.php';
require_once DIR_LIBRARIES.'flat-files.php';
require_once DIR_LIBRARIES.'image-jobs.php';
require_once DIR_LIBRARIES.'trash.php';
require_once DIR_PLUGINS.'plugins-admin.php';

require_once DIR_DATABASE.'_fields.php';
require_once DIR_CORE.'common-admin.php';
require_once DIR_CORE.'pages.php';
require_once DIR_CORE.'pages-admin.php';
require_once DIR_CORE.'lang-admin.php';
require_once DIR_CORE.'files.php';
require_once DIR_CORE.'files-admin.php';

$p = !empty( $p ) ? strip_tags( $p ) : 'dashboard';

if( !isset( $iTypeSearch ) )
  $iTypeSearch = 1;

if( $p == 'search' ){
  $aSearchActions = Array( 1 => 'pages-list' );
  $p = ( isset( $aSearchActions[$iTypeSearch] ) ) ? $aSearchActions[$iTypeSearch] : null;
}
elseif( $p == 'dashboard' || $p == 'login' )
  $sNotifications = listNotifications( );

$sPhrase = isset( $sPhrase ) && !empty( $sPhrase ) ? trim( changeSpecialChars( htmlspecialchars( stripslashes( $sPhrase ) ) ) ) : null;
if( !isset( $sSort ) )
  $sSort = null;
$aActions = getAction( $p );

loginActions( $p, SESSION_KEY_NAME );

$oFFS = FlatFilesSerialize::getInstance( );
$oImage = ImageJobs::getInstance( );
$oPage = PagesAdmin::getInstance( );
$oFile = FilesAdmin::getInstance( );
$content = null;

if( ( strstr( $p, '-delete' ) || count( $_POST ) > 0 ) && ( ( !empty( $_SERVER['HTTP_REFERER'] ) && !strstr( $_SERVER['HTTP_REFERER'], $_SERVER['SCRIPT_NAME'] ) ) || ( empty( $_SERVER['HTTP_REFERER'] ) && strstr( $_SERVER['PHP_SELF'], 'admin.php' ) && $_SERVER['SERVER_ADDR'] != '127.0.0.1' && !strstr( $_SERVER['HTTP_HOST'], 'localhost' ) ) ) ){
  header( 'Location: '.$_SERVER['PHP_SELF'].'?p=error' );
  exit;
}

// back-end dashboard
if( $p == 'dashboard' || $p == 'login' ){
  require_once DIR_TEMPLATES.'admin/home.php';
}

// page actions
elseif( $p == 'pages-list' ){
  $iTypeSearch = 1;
  require_once DIR_TEMPLATES.'admin/pages.php';
}
elseif( $p == 'pages-form' ){
  $iTypeSearch = 1;
  require_once DIR_TEMPLATES.'admin/pages-form.php';
}
elseif( $p == 'pages-delete' && isset( $iPage ) && is_numeric( $iPage ) ){
  if( !isset( $bWithoutFiles ) )
    $bWithoutFiles = null;
  $oPage->deletePage( $iPage, $bWithoutFiles );
  header( 'Location: '.$_SERVER['PHP_SELF'].'?p=pages-list&sOption=del' );
  exit;
}

// translation actions
elseif( $p == 'lang-list' || $p == 'lang-translations' ){
  require_once DIR_TEMPLATES.'admin/languages.php';
}
elseif( $p == 'lang-form' ){
  require_once DIR_TEMPLATES.'admin/languages-form.php';
}
elseif( $p == 'lang-delete' && isset( $sLanguage ) && !empty( $sLanguage ) ){
  deleteLanguage( $sLanguage );
  header( 'Location: '.$_SERVER['PHP_SELF'].'?p=lang-list&sOption=del' );
  exit;
}

// settings
elseif( $p == 'tools-config' ){
  require_once DIR_TEMPLATES.'admin/settings.php';
}

// file actions
elseif( $p == 'files-in-dir' ){
  header( 'Cache-Control: no-cache' );
  header( 'Content-type: text/html' );
  echo $oFile->listFilesInDir( 'time' );
  exit;
}
elseif( $p == 'files-upload' && !empty( $sFileName ) ){
  echo $oFile->uploadFile( $sFileName );
  exit;
}
// plugins actions

// error page
else{
  require_once DIR_TEMPLATES.'admin/_header.php'; // include headers
  require_once DIR_TEMPLATES.'admin/_menu.php'; // include menu
  echo '<div id="msg" class="error">'.$lang['Operation_unknown'].'</div>';
  require_once DIR_TEMPLATES.'admin/_footer.php'; // include menu
}
?>