<?php 
$query = new WP_Query( array(
    // razel_post - came from register post type name
    "post_type"=> "razel_post",
) );
?>
<!-- // shortcode -->

<ul>
    <?php while ( $query->have_posts() ) : 
        $query->the_post();    
    ?>
    <li><?php the_title(); ?></li>
    <?php endwhile; ?>
</ul>