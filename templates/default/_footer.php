<?php
if( !defined( 'CUSTOMER_PAGE' ) )
  exit;
?>
        <div id="options"><div class="print"><a href="javascript:window.print();"><?php echo $lang['print']; ?></a></div><div class="back"><a href="javascript:history.back();">&laquo; <?php echo $lang['back']; ?></a></div></div>
      </div>
    <div id="backToTop">
        <a href="#container"><img src="templates/default/img/back_to_top.png" alt="Do góry" border="0" /></a>
      </div>
    </div>
  </div>
  <div id="foot"><?php // footer starts here ?>
    <div class="container">
      <div id="copy"><?php echo $config['foot_info']; ?></div><!-- copyrights here -->
      <!-- 
        Read the license before you change the footer
        www.opensolution.org/licenses.html
      -->
      <div class="foot" id="powered"><a href="http://opensolution.org/"><img src="<?php echo $config['dir_skin']; ?>img/quick.cms.png" alt="Script logo" width="171" height="14" /></a></div>
    </div>
  </div>
</div>
</body>
</html>