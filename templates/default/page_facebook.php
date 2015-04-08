<?php 
// More about design modifications - www.opensolution.org/Quick.Cms/docs/?id=en-design
if( !defined( 'CUSTOMER_PAGE' ) )
  exit;

require_once DIR_SKIN.'_header.php'; // include design of header
?>
<div id="page">
<?php
if( isset( $aData['sName'] ) ){ // displaying pages and subpages content
  echo '<h1>'.$aData['sName'].'</h1>'; // displaying page name

  if( isset( $aData['sPagesTree'] ) )
    echo '<div class="breadcrumb">'.$aData['sPagesTree'].'</div>'; // displaying page tree (breadcrumb)
  
  echo $oFile->listImagesByTypes( $aData['iPage'], 1 ); // displaying images with type: left
  
  echo $oFile->listImagesByTypes( $aData['iPage'], 2 ); // displaying images with type: right
  
  if( isset( $aData['sDescriptionFull'] ) )
    echo '<div class="content" id="pageDescription">'.$aData['sDescriptionFull'].'</div>'; // full description

  if( isset( $aData['sPages'] ) )
    echo '<div class="pages">'.$lang['Pages'].': <ul>'.$aData['sPages'].'</ul></div>'; // full description pagination
  
  echo $oFile->listFiles( $aData['iPage'] ); // display files included to the page
  
  if( $aData['iSubpagesShow'] > 0 )
    echo $oPage->listSubpages( $aData['iPage'], $aData['iSubpagesShow'] ); // displaying subpages
  ?>
  <div class="clear"> </div><h3 id="commentTitle"><?php echo $GLOBALS['lang']['Facebook_title']; ?></h3>
  <div id="facebookComments">
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/<?php echo LANGUAGE.'_'.strtoupper( LANGUAGE ); ?>/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].'/'.$aData['sLinkName']; ?>" data-num-posts="3" data-width="650" data-order-by="time"></div>
  </div>
  <?php
}
else{
  echo '<div class="message" id="error"><h2>'.$lang['Data_not_found'].'</h2></div>'; // displaying 404 error
}
?>
</div>
<?php
require_once DIR_SKIN.'_footer.php'; // include design of footer
?>
