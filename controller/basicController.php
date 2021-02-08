<?php

class BasicController {
  

  public function redirectPage($location) {

    if (!headers_sent()) {
        header('Location: '.$location);
        exit;
    } else {
        ?>
        <script type="text/javascript">
            window.location.href="<?=$location?>";
        </script>
        <noscript>
            <meta http-equiv="refresh" content="0;url=<?=$location?>" />
        </noscript>
        <?php
        exit;
    }
  }

}

?>