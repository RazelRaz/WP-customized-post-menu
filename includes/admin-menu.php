<?php

class Admin_Menu_SA_WP_Plugin {
  public function __construct() {
    add_action("admin_menu", array( $this,"admin_menu") );
  }

  public function admin_menu() {
    add_menu_page(
      'SA WP Plugin',
      'SA WP Plugin',
      'manage_options',
      'sa_wp_plugin',
      array( $this,'sa_wp_plugin_callback')
    );
  }

  public function sa_wp_plugin_callback(){

    $post_args = array(
      "post_type"=> "post",
    );

    if ( isset($_GET['sa_category']) && $_GET['sa_category'] != "-1" ) {
      $post_args["tax_query"] = array(
        array(
          "taxonomy"=> "category",
          "field" => "term_id",
          "terms" => $_GET['sa_category'],
        ),
      );
    }

    $posts = get_posts( $post_args );

    // categories
    $terms = get_terms( array( 
      'taxonomy' => 'category',
    ));

    print_r( $terms );

    // Those files which contains html - we will ise include_once
    include_once __DIR__ .'/templates/sa-wp-plugin-menu.php';

    // echo 'Hello WORDPRESS';
  }

}

