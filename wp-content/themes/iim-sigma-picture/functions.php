<?php
/**
 *
 * functions.php
 * Fichier de modification du comportement du WordPress
 *
 * Appel des fonctions selon l'utilisation : ajax, admin, front ou all
 * Inclure les fonctions à utiliser sur le projet dans le fichier correspondant function/
 * Inclure la fonction dans un fichier à son nom function/front/ ou function/admin/ ou function/ajax/
 *
 * Les fonctions récurentes sur les projets sont déjà dans les répertoires associés,
 * il faut décommenter leur appel dans le fichier associé dans function/
 *
 */
$templatepath = get_template_directory();

if ( defined( 'DOING_AJAX' ) && DOING_AJAX && is_admin() ) {

	include( $templatepath . '/function/ajax.php' );

} elseif ( is_admin() ) {

	include( $templatepath . '/function/admin.php' );

} elseif ( ! defined( 'XMLRPC_REQUEST' ) && ! defined( 'DOING_CRON' ) ) {

	include( $templatepath . '/function/front.php' );

}

include( $templatepath . '/function/all.php' );


/**
 *
 * Liste des fonctions pour une utilisation front, back et ajax
 *
 */

//remove_role('subscriber');
//remove_role('contributor');
//remove_role('editor');
//remove_role('author');


/**
 * Custom theme
 */

// CUSTOM POST TYPE
/*function cpt_init() {
    // Valeurs entrés
    $nom = "site";
    $menu_name = "Sites";
    $genre = "M";

    $result = init($nom,$menu_name,$genre);
    CreateCPT($result);
}
add_action('init', 'cpt_init');*/

// Ajout du rôle client
function createRoleClient() {
	global $wp_roles;
	if ( ! isset( $wp_roles ) ) {
		$wp_roles = new WP_Roles();
	}
	$adm = $wp_roles->get_role( 'administrator' );
	$wp_roles->add_role( 'client', 'Client', $adm->capabilities );
}

add_action( 'init', 'createRoleClient' );

function add_js_scripts() {
	if ( is_page( get_page_by_path('find-user') ) ) {
		wp_enqueue_script( 'fetch-files', get_template_directory_uri() . '/script/build/fetch-files.js', [ 'jquery' ], '1.0', true );

		wp_localize_script( 'fetch-files', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	}
}

add_action( 'wp_enqueue_scripts', 'add_js_scripts' );

include( $templatepath . '/function/front/fetchUserFiles.php' );


//Fonction Login
function my_custom_login()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-style.css" />';
}
add_action('login_head', 'my_custom_login');

function custom_login_redirect( $redirect_to, $request, $user )
{
    global $user;
    if( isset( $user->roles ) && is_array( $user->roles ) ) {
        if( in_array( "administrator", $user->roles ) ) {
            return get_the_permalink(get_page_by_path('dashboard'));
        } else {
            return get_the_permalink(get_page_by_path('dashboard'));
        }
    }
    else
    {
        return $redirect_to;
    }
}
add_filter("login_redirect", "custom_login_redirect", 10, 3);

