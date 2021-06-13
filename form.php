<?php

class ltpform{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'ltp_create_admin_page'));
    }


    public function ltp_create_admin_page(){
        $page_title = __('Localhost to IP', 'ltp');
        $menu_title = __('Localhost to IP', 'ltp');
        $capability = 'manage_options';
        $slug = 'ltp_admin';
        $callback = array($this, 'ltp_admin_content');
        add_menu_page($page_title, $menu_title, $capability, $slug, $callback);
    }


    public function ltp_admin_content(){
        wp_enqueue_style('plugin-style', plugin_dir_url(__FILE__) . 'admin/css/bootstrap.min.css', array(), _S_VERSION);
        wp_enqueue_style('plugin-bootstrap', plugin_dir_url(__FILE__) . 'admin/css/style.css', array(), _S_VERSION);

        require_once plugin_dir_path(__FILE__).'/form_field.php';
    }
}

new ltpform();