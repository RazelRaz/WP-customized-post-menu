<?php
/**
 * Custom Post Type
 */


 class SA_WP_Plugin_Post_Type {
    public function __construct() {
        add_action("init", array( $this,"init") );
    }

    public function init() {

        register_post_type( 'razel_post', array(
            'public' => true,
            'labels'=> array(
                'name' => 'Razel Posts',
                'singular_name' => 'Razel Post',
                'add_new' => 'Create New Razel Post',
                'add_new_item' => 'Add New Razel Post....',
                'edit_item' => 'Edit Now...',
                'search_items' => 'Search From Razel Post',
            ),
            'menu_position' => 3,
            'menu_icon' => 'dashicons-pets',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
            'rewrite' => array(
				'slug' => 'razel',
			),
            // 'show_in_rest' => true,
            
        ) );

        add_shortcode('razel-posts', array( $this,'display_razel_posts') );
    }

    public function display_razel_posts () {
        ob_start();
        include __DIR__ . '/templates/razel-posts.php';


        return ob_get_clean();
    }

 }