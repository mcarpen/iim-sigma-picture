<?php
add_action( 'wp_ajax_fetch_files', 'fetch_files' );
add_action( 'wp_ajax_nopriv_fetch_files', 'fetch_files' );

function fetch_files() {

	$email = $_POST['param'];

	$args = array(
		'post_type'      => 'files',
		'posts_per_page' => - 1,
		's'              => $email,
	);

	$ajax_query = new WP_Query( $args );

	$adminFiles = [];
	$userFiles   = [];

	if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
		$isAdmin  = get_field( 'is_admin' );
		$fileName = get_field( 'name' );
		$path     = get_field( 'path' );

		if ( $isAdmin ) {
			$adminFiles[] = [
				'name' => $fileName,
				'path' => $path,
			];
		} else {
			$userFiles[] = [
				'name' => $fileName,
				'path' => $path,
			];
		}
	endwhile;
	endif;

	$data = [
		$adminFiles,
		$userFiles,
	];

	echo json_encode($data);

	die();
}
