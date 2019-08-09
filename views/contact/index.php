<?php define('logo_img','logo-only-org.png') ?>
<div class="container wow fadeInUp">
    <?php $this->load_partial('top-nav'); ?>
</div>

<?php
$this->load_partial('header');
$this->load_section('contact');
$this->load_partial('footer');