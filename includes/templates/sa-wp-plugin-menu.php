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
</div>




  <table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          foreach ( $posts as $post ) : 

          $author = get_user_by('id', $post->post_author);
          // print_r($author);
      ?>
      <tr>
        <td><?php echo $post->post_title; ?></td>
        <td><?php echo $author->data->display_name; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>