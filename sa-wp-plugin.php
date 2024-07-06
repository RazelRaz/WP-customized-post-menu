<?php
/*
 * Plugin Name:       SA WP Plugin
 * Description:       This is a basic Plugin
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Razel Ahmed
 * Author URI:        https://razelahmed.com
 */

 if ( ! defined('ABSPATH') ) {
    exit;
 }

 
 class SA_WP_Plugin {

    private static $instance;

    public static function getInstance() {

      //if there is no instance
      if ( ! self::$instance ) {
        self::$instance = new self();
      }

      return self::$instance;

    }

    private function __construct() {
        $this->require_classes();
    }

    private function require_classes() {
      require_once __DIR__ ."/includes/admin-menu.php";
      require_once __DIR__ ."/includes/page-post-column.php";
      
      new Admin_Menu_SA_WP_Plugin();
      new SA_WP_Plugin_Page_Post_column();
    }

 }

SA_WP_Plugin::getInstance();