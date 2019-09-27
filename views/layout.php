<!DOCTYPE html>
<html lang="en">
<?php $this->load_partial('head') ?>
<body>
<div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=529852907793033&autoLogAppEvents=1"></script>
    <div id="preloader"></div>
    
    <?php
        
        $this->load_partial('header');

        $e = new Exception();
        $trace = $e->getTrace();
        $view_src = array_pop($trace);
        $this->load_view($view_src['class'].'/'.$view_src['function']);
        
        $this->load_partial('footer');
    ?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <?php $this->load_partial('scripts') ?>
</body>
</html>
