<?php
/*
 Template Name: Press Highlights Gallery
 */

get_header();
/* function press_init() {
	// create a new taxonomy
	register_taxonomy(
		'press',
		'post',
		array(
			'label' => __( 'Press Highlights' ),
			'rewrite' => array( 'slug' => 'highlights' ),
			'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			)
		)
	);
}
add_action( 'init', 'press_init' ); */


if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		//get the page settings
		$subtitle=get_post_meta( $post->ID, 'subtitle_value', true );
		$slider=get_post_meta( $post->ID, 'slider_value', $single = true );
		$slider_prefix=get_post_meta( $post->ID, 'slider_name_value', true );
		if ( $slider_prefix=='default' ) {
			$slider_prefix='';
		}
		$layout=get_post_meta( $post->ID, 'layout_value', true );
		if ( $layout=='' ) {
			$layout='right';
		}
		$show_title=get_opt( '_show_page_title' );
		$sidebar=get_post_meta( $post->ID, 'sidebar_value', $single = true );
		if ( $sidebar=='' ) {
			$sidebar='default';
		}

		//include the page header template
		locate_template( array( 'includes/page-header.php' ), true, true );
?>

<div id="content-container" class="content-gradient <?php echo $layoutclass; ?> ">
	<div id="<?php echo $content_id; ?>">
	<!--content-->
    <?php

		if ( $show_title!='off' ) {?>
    	<h1 class="page-heading"><?php the_title(); ?></h1><hr/>
    <?php }

		the_content(); echo 
		wp_link_pages();
		echo pexeto_get_share_btns_html($post->ID, 'page');
	}
}

?>

	</div> <!-- end content-->
<?php
/* $allusers = get_users(array( 'fields' => array( 'user_email' ))); */
/* echo "<textarea>" . print_r($allusers) . "</textarea>" */ ?>
<ul id="highlit-blogs">
<?php $args = array(
	'posts_per_page'   => 30,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => 'In the News',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_array = get_posts( $args ); ?>
<!-- Initial <?php /* print_r($posts_array); */ ?> -->

<?php /*$n__ = []; this holds the posts */
$a_ = 0; /* this counts current iteration */

foreach( $posts_array as $post ) : $n__[$a_][0] = $posts_array[$a_]->ID; $n__[$a_][1] = $posts_array[$a_]->post_title; $n__[$a_][2] = get_post_meta($n__[$a_][0], "_yoast_wpseo_metadesc", true); $n__[$a_][3] = get_the_post_thumbnail($n__[$a_][0]); /*the_post_thumbnail();*/ 
/*setup_postdata($post);*/ 
/* if ( $a_ & 1 ) {
  $b_ = "right";
} else {
  $b_ = "left";
} */
$b_ = "left"; ?>
    <!-- li class="highlight" id="ht-blog-<?php echo $a_; ?>" name="<?php echo $n__[$a_][0]; ?>" style="float: <?php echo $b_; ?>" ><?php /* print_r($n__); */ ?></li-->
    <!-- Title I: <?php the_title(); ?> -->
    <!-- Title II: <?php echo $posts_array[$a_]->post_title; /* remember to sanitize */ ?> -->
    <!-- SEO Description I: "<?php echo get_post_meta($posts_array[$a_]->ID, "_yoast_wpseo_metadesc", true); ?>" -->
    <!-- SEO Description II: <?php echo $n__[$a_][0] . get_post_meta($n__[$a_][0], "_yoast_wpseo_metadesc", true); ?> -->
    <!-- SEO Description III: <?php the_excerpt(); ?> -->
    <!-- SEO Description IV: <?php echo $posts_array[$a_]->post_excerpt; ?> -->
    <!-- Featured Image: <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?> -->
<?php /* echo "<textarea>" . print_r($post) . "</textarea>" */ ?>
                                                               . 
    <!-- td valign=top>
    <p style="text-align: center"><strong><?php the_title(); ?></strong></p>
    <p><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></p>
    <p><?php echo $n__[$a_][3]; ?></p>
    </td -->
    <!-- td valign=top><p><?php echo get_post_meta($n__[$a_][0], "_yoast_wpseo_metadesc", true); ?></p></td -->
                                                               . 
<?php $a_ += 1; endforeach; ?>

    <!-- SEO Description III: <?php echo get_bloginfo('description'); /* returns the site total meta desc */ ?> -->

<?php /*if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		// Your loop code
                echo "<!-- $n__ -->";
                $n__ = $n__ + 1;
	endwhile;
else :
	echo wpautop( 'Sorry, no posts were found' );
endif;*/
?>
</ul>
<?php get_footer(); ?>
