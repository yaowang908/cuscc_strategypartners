<?php
    /**
    *Plugin Name: cuscc_StrategyPartners
    *Author: Yao Wang
    *Version:1.0.0
    */
    defined('ABSPATH') or die("Cannot access pages directly.");
    /*deny direct access*/
    add_action ( 'admin_menu' , 'cuscc_StrategyPartners_register_admin_menu_page' ); 

    function cuscc_StrategyPartners_register_admin_menu_page(){
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

     //main body
    function cuscc_strategypartners_display_admin_menu_page(){
       include_once "cuscc_strategypartners_admin_panel_body.php";
    }
    
    //add admin panel css and js
    function cuscc_strategypartners_admin_page_css_and_js($hook){
        //load only on ?page=cuscc_members
        if($hook != 'toplevel_page_cuscc_StrategyPartners'){
            return;
        }
        wp_enqueue_style('cuscc_strategypartners_admin_page_css', plugins_url('plugin_css/cuscc_strategypartners_admin_page_css.css',__FILE__));
        wp_enqueue_script('cuscc_strategypartners_admin_page_js', plugins_url('plugin_js/cuscc_strategypartners_admin_page_js.js',__FILE__));
        //wp_enqueue_script('jquery-3.1.1.min', get_stylesheet_directory_uri() .'/child_js/jquery-3.1.1.min.js',' ',' ',true);
        //wp js API
        wp_enqueue_media();
        wp_localize_script('cuscc_strategypartners_admin_page_js','sp_add_nonce',array(
            'sp_additem_nonce' => wp_create_nonce('sp_add_context'),
            'sp_delete_nonce' => wp_create_nonce('sp_delete_context')
        ));
    }
    
    add_action('admin_enqueue_scripts', 'cuscc_strategypartners_admin_page_css_and_js');
    
    //add front page css and js
    function front_page_scripts_method_strategypartners(){
        //echo "Does this output to the actual page?";
       //echo plugins_url('plugin_js/cuscc_members_front_page_js.js',__FILE__);
        wp_enqueue_style('cuscc_strategypartners_front_css123', plugins_url('plugin_css/cuscc_strategypartners_front_page_css.css',__FILE__));
        wp_enqueue_script('cuscc_strategypartners_front_js123', plugins_url('plugin_js/cuscc_strategypartners_front_page_js.js',__FILE__));
        
    }

    add_action('wp_enqueue_scripts', 'front_page_scripts_method_strategypartners',99);

function strategypartners_ajax_callback(){
    //permission check for security
    debug_to_console( "ajax" );    
    if(isset($_POST['sptoadditem_nonce'])&&wp_verify_nonce($_POST['sptoadditem_nonce'], 'sp_add_context'))
        {        
            $sp_post_array_url = $_POST['sp_post_array_url'];
            $sp_post_array_website = $_POST['sp_post_array_website'];
            $sp_post_array_companyname = $_POST['sp_post_array_companyname'];
            //debug_to_console($_POST['post_array'][url]);
            $total_strategypartners = (get_option('total_strategypartners')==false)? array() : get_option('total_strategypartners');
            $this_item = (get_option($sp_post_array_companyname)==false)? array() : get_option($sp_post_array_companyname);
            //this_member array(0=>url,1=>companyname,2=>website)
            if(in_array($sp_post_array_companyname,$total_strategypartners)){
                //already exit 
                //echo json_encode($total_members);
                
            }else{
                //new member
                array_push($total_strategypartners,$sp_post_array_companyname);
                $json_array = array('url'=>$post_array_url,'website'=>$post_array_website,'companyname'=>$post_array_companyname);
                //$total_members[$post_array.companyname] = $post_array;
                echo json_encode($json_array);
            }
            $this_item = array($post_array_url,$post_array_companyname,$post_array_website);
            update_option($sp_post_array_companyname,$this_item);
            update_option('total_strategypartners',$total_strategypartners);
            //must have die() otherwise return 0
            wp_die();
            
        }else{

            die('Permissions check failed');

        }
}
add_action('wp_ajax_sp_ajax_callback','strategypartners_ajax_callback');


?>