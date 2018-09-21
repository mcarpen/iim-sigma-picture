<?php
/*
    Template Name: Dashboard
*/
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php
	if ( checkRole() === 'admin' ):
		include(locate_template('template/partials/a-dashboard.php'));
	else:
		include(locate_template('template/partials/u-dashboard.php'));
	endif;
	?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
