<div class="wrap">
  <h1 class="wp-heading-inline">Customized Post</h1>

  <?php 

      // $posts = get_posts(array(
      //   "post_type"=> "post",
      // ));

      // print_r($posts);
  ?>


<div class="tablenav top">
    <form method="get" action="<?php echo admin_url('admin.php'); ?>">

        <!-- page parameter -->
        <input type="hidden" name="page" value="sa_wp_plugin">

        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>

            <?php 
              $slected_category = isset($_GET['sa_category']) ? $_GET['sa_category'] : '-1';
            ?>

            <select name="sa_category" id="bulk-action-selector-top">
                <option value="-1" <?php selected( '-1', $slected_category ); ?>>All Categories</option>

                <?php foreach ( $terms as $term ) : ?>
                <option value="<?php echo $term->term_id; ?>" class="hide-if-no-js" <?php selected( $term->term_id, $slected_category ); ?>><?php echo $term->name; ?></option>
                <?php endforeach; ?>

            </select>
            <input type="submit" id="doaction" class="button action" value="Apply">
        </div>
    </form>

    <div>
    <form method="get" action="<?php echo admin_url('admin.php'); ?>">
        <!-- page parameter -->
        <input type="hidden" name="page" value="sa_wp_plugin">

        <select name="m" id="filter-by-date">
          <option value="0">All dates</option>
          <?php
          global $wpdb;
          $months = $wpdb->get_results("
            SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month
            FROM $wpdb->posts
            WHERE post_type = 'post' AND post_status = 'publish'
            ORDER BY post_date DESC
          ");
          foreach ($months as $month) :
            $month_value = sprintf('%04d%02d', $month->year, $month->month);
            $month_name = date('F Y', mktime(0, 0, 0, $month->month, 1, $month->year));
          ?>
            <option value="<?php echo esc_attr($month_value); ?>" <?php selected($month_value, isset($_GET['m']) ? $_GET['m'] : ''); ?>>
              <?php echo esc_html($month_name); ?>
            </option>
          <?php endforeach; ?>
        </select>
        <input type="submit" id="doaction" class="button action" value="Apply">
      </form>
    </div>

</div>




  <table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          foreach ( $posts as $post ) : 

          $author = get_user_by('id', $post->post_author);
          // print_r($author);
          // $post_categories = get_the_category($post->ID);
          // print_r( $post_categories );
          
      ?>
      <tr>
        <td><?php echo $post->post_title; ?></td>
        <td><?php echo $author->data->display_name; ?></td>
        <td>
        <?php
              $post_categories = get_the_category($post->ID);
              $category_names = wp_list_pluck($post_categories, 'name');
              echo implode(', ', $category_names);
              ?>
        </td>
        <td><?php echo esc_html(get_the_date('', $post->ID)); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>