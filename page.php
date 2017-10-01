<?php
/**
 *
 * @package WordPress
 * @subpackage APACN
 * @since APACN 1.0
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php 

	$image = get_the_post_thumbnail( get_the_ID(), 'large' );
	

?>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
