<ul id="sidebar-left">
    <?php 
        if(isset($sb_menu)){
            foreach($sb_menu as $link){
                echo "<li{$this->is_menu_active($link->href, false, 'active')}><a href='{$link->href}'><i class='fa {$link->icon}'></i> {$link->title}</a></li>";
            }
        }
    ?>

</ul>

