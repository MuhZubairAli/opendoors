<?php

    $this->load_section('hero',array(
        'hero_heading' => 'Paid Database for Commercial use',
        'hero_subheading' => 'We are offering variety of Datasets for commercial use, checkout the sub-sections for more information regarding data types, sample data and pricing.',
        'hero_action_link_href' => '/paid-data',
        'hero_action_link_title' => 'Learn more about paid data'
    ));

?>

<div class="container contents">
    <div class="row">
        <div class="col-md-3">
            <h1 class="title">Sidebar</h1>
        </div>

        <div class="col-md-9">
            <?php $this->load_section('paid-data-intro') ?>
        </div>
    </div>
</div>