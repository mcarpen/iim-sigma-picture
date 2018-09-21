<?php
add_action( 'wp_ajax_fetch_files', 'fetch_files' );
add_action( 'wp_ajax_nopriv_fetch_files', 'fetch_files' );

function fetch_files() {

	$email = $_POST['param'];

	$args = array(
		'post_type'      => 'files',
		'posts_per_page' => 50,
		's'              => $email,
	);

	$ajax_query = new WP_Query( $args );

	if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
		$isAdmin = get_field( 'is_admin' );
		if ( $isAdmin ) {
			$fileName = get_field( 'name' );
			echo '<li><a href="' . get_field('path') . '" target="_blank" title="Afficher">' . $fileName . '</a></li>';
		}
	endwhile;
	endif;

	die();
}
