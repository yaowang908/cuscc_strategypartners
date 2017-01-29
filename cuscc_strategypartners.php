<?php
    /**
    *Plugin Name: cuscc_StrategyPartners
    *Author: Yao Wang
    *Version:1.0.0
    */
    defined('ABSPATH') or die("Cannot access pages directly.");
    /*deny direct access*/
    add_action ( 'admin_menu' , 'cuscc_StrategyPartners_display_admin_menu_page' ); 

    function cuscc_StrategyPartners_display_admin_menu_page(){
        add_menu_page(
            'CUSCC StrategyPartners',    //string $page_title
            'CUSCC StrategyPartners',    //string $menu_title
            'manage_options',       //string $capability
            'cuscc_StrategyPartners',        //string $menu_slug
            'cuscc_StrategyPartners_display_admin_menu_page', //callback $function = ''
            ' ',                                //string $icon_url = ''
            6                                    //int $position
        );
    }