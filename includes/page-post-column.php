<?php
/**
 * In this file will add custom column in page post table
 */
class SA_WP_Plugin_Page_Post_column {

    /**
     * constructor
     */
    public function __construct() {
        add_filter("manage_page_posts_columns", array( $this,"posts_columns"), 10, 1 );
        add_action("manage_page_posts_custom_column", array( $this,"add_column_value"), 10, 2 );
        add_action("wp_head", array( $this,"count_post_view"));
        add_filter("manage_edit-page_sortable_columns", array( $this,"sortable_columns"), 10, 1 );

    }

    /**
     * Add Column heading
     */
    public function posts_columns( $columns ) {

        // error_log( print_r( $columns, true ) );
        $new_columns = array();
        foreach ( $columns as $key => $column ) {
            if ("cb" == $key) {
                $new_columns[$key] = $column;
                $new_columns["image"] = "Thumbnail";
            } else {
                $new_columns[$key] = $column;
            }

            // for view count
            if ('author' == $key) {
                $new_columns[$key] = $column;
                $new_columns["view"] = "Views";
            }
            
        }

    return $new_columns;
        
    }

    /**
     * Add Column Value to table
    */
    public function add_column_value( $column_name, $post_id ) {
        if ( "image"== $column_name ) {
            // $column_name = "helloo";
            // echo  $column_name;
            if ( has_post_thumbnail($post_id) ) {
               echo get_the_post_thumbnail( $post_id, 'thumbnail' );
            } else {
                echo 'No image avaiable!';
            }
        }

        // add view count value to table
        if( 'view' == $column_name ){
            $view_count_current = get_post_meta( $post_id,'_view_count', true );
            echo $view_count_current ? $view_count_current : 0;
        }

    }

    /**
     * Track post view count
     */
    public function count_post_view( ) {
        // var_dump('Here Im');
        if (is_page()) {
            global $post;

            // get Previous count
            $view_count_current = get_post_meta( $post->ID,'_view_count', true );
            if ( ! $view_count_current ) { 
                $view_count_current = 0;
            } else {
                $view_count_current = intval( $view_count_current );
            }

            // Increment
            $view_count_current+=1;

            // Save New Count
            update_post_meta( $post->ID,'_view_count', $view_count_current);

            // print_r( $post->ID );
        }
    }

    /**
     * Handle sorable Column
     */
    public function sortable_columns($columns){
        $columns['view'] = 'view';
        return $columns;
    }




}