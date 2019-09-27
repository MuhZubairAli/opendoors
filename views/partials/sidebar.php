<ul id="sidebar-left">
    <?php
        $menu_fetch_handler = $this->db->select(array(
            'table' => 'sb_menu_groups',
            '*' => '',
            'where' => "sb_group='{$sb_menu}'"
        ));

        if($menu_fetch_handler['status']){
            $sb_menu_group = array();
            while($data = $menu_fetch_handler['result']->fetch_assoc()){
                $sb_menu_group[] = (object)$data;
            }
        }

        if(isset($sb_menu_group)){
            foreach($sb_menu_group as $sb_menu_item){
                echo "<li{$this->is_menu_active($sb_menu_item->link_href, false, 'active')}><a href='{$sb_menu_item->link_href}'><i class='fa {$sb_menu_item->link_icon}'></i> {$sb_menu_item->link_title}</a></li>";
            }
        }
    ?>

</ul>

