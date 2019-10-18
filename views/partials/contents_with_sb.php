<div class="container contents">
    <div class="row">
        <div class="col-sm-4 col-md-3 hidden-xs">
            <?php $this->load_partial('sidebar') ?>
        </div>

        <div class="col-sm-8 col-md-9">
            <?php $this->load_section($contents_section) ?>
            <!-- <div class="fb-comments" data-href="<?= $this->url($_SERVER['route']['href']) ?>" data-width="100%" data-numposts="5"></div> -->
        </div>
    </div>
</div>