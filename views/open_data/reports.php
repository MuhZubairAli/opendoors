<?php


    $this->load_section('hero',array(
        'hero_heading' => 'An Open Database for Everyone',
        'hero_subheading' => 'Open data conist of multiple datasets available for free, Data is intended for reasearch and education',
        'hero_action_link_href' => '#',
        'hero_action_link_title' => 'Learn more about open data'
    ));
	
    $this->load_partial('contents_with_sb',array(
        'contents_section' => 'report',
        'sb_menu' => 'report_group'
    ));