<?php
// More about design modifications - www.opensolution.org/Quick.Cms/docs/?id=en-design
if( !defined( 'CUSTOMER_PAGE' ) )
  exit;

echo '<?xml'; ?> version="1.0" encoding="<?php echo $config['charset']; ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $config['language']; ?>" lang="<?php echo $config['language']; ?>">
<head>
  <title><?php echo $sTitle.$config['title']; ?></title>
  <meta name="Language" content="<?php echo $config['language']; ?>" />
  <meta name="Description" content="<?php echo $sDescription; ?>" />
  <meta name="Generator" content="Quick.Cms v<?php echo $config['version']; ?>" />

  <script type="text/javascript" src="<?php echo $config['dir_core']; ?>common.js"></script>
  <script type="text/javascript" src="<?php echo $config['dir_plugins']; ?>mlbox/mlbox.js"></script>
  <?php displayAlternateTranslations( ); ?>
  <link rel="stylesheet" href="<?php echo $config['dir_skin'].$config['style']; ?>" />
<?php if( !defined( 'JQUERY-LOADED' ) ){ echo '<script type="text/javascript" src="'.$config['dir_plugins'].'jquery-1.9.1.min.js"></script>'; define( 'JQUERY-LOADED', true ); } ?>
  <script type="text/javascript">$(function(){ backToTop(); });</script>
</head>
<body<?php if( isset( $aData['iPage'] ) && is_numeric( $aData['iPage'] ) ) echo ' id="page'.$aData['iPage'].'"'; ?>>
<ul id="skiplinks">
  <li><a href="#menu1" tabindex="1"><?php echo $lang['Skip_to_main_menu']; ?></a></li>
  <li><a href="#content" tabindex="2"><?php echo $lang['Skip_to_content']; ?></a></li>
</ul>

<div id="container">
  <div id="header">
    <div id="head1"><?php // banner, logo and slogan starts here ?>
      <div class="container">
        <div id="logo"><?php // logo and slogan ?>
          <div id="title"><a href="./" tabindex="3"><?php echo $config['logo']; ?></a></div>
          <div id="slogan"><?php echo $config['slogan']; ?></div>
        </div>
      </div>
    </div>
    <div id="head2"><?php // top menu starts here ?>
      <div class="container">
        <?php echo $oPage->throwMenu( 1, $iContent, 0 ); // content of top menu ?>
      </div>
    </div>
  </div>
  <div id="body">
    <div class="container">
      <div id="column"><?php // left column with left menu ?>
        <?php echo $oPage->throwMenu( 2, $iContent, 1, true ); // content of left menu ?>
      </div>
      <div id="content">