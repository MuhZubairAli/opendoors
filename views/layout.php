<!DOCTYPE html>
<html lang="en">
<?php $this->load_partial('head') ?>
<body>
<div id="fb-root"></div>
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
