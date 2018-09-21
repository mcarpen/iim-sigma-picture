<?php
include __DIR__ . "/../../../../../wp-load.php";

$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '', DB_USER, DB_PASSWORD);
/**
 * PHP Server-Side Example for Fine Uploader (traditional endpoint handler).
 * Maintained by Widen Enterprises.
 *
 * This example:
 *  - handles chunked and non-chunked requests
 *  - supports the concurrent chunking feature
 *  - assumes all upload requests are multipart encoded
 *  - supports the delete file feature
 *
 * Follow these steps to get up and running with Fine Uploader in a PHP environment:
 *
 * 1. Setup your client-side code, as documented on http://docs.fineuploader.com.
 *
 * 2. Copy this file and handler.php to your server.
 *
 * 3. Ensure your php.ini file contains appropriate values for
 *    max_input_time, upload_max_filesize and post_max_size.
 *
 * 4. Ensure your "chunks" and "files" folders exist and are writable.
 *    "chunks" is only needed if you have enabled the chunking feature client-side.
 *
 * 5. If you have chunking enabled in Fine Uploader, you MUST set a value for the `chunking.success.endpoint` option.
 *    This will be called by Fine Uploader when all chunks for a file have been successfully uploaded, triggering the
 *    PHP server to combine all parts into one file. This is particularly useful for the concurrent chunking feature,
 *    but is now required in all cases if you are making use of this PHP example.
 */
// Include the upload handler class
require_once "handler.php";
$uploader = new UploadHandler();
// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
$uploader->allowedExtensions = array(); // all files types allowed by default
// Specify max file size in bytes.
$uploader->sizeLimit = null;
// Specify the input name set in the javascript.
$uploader->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default
// If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
$uploader->chunksFolder = "chunks";
$method                 = get_request_method();
// This will retrieve the "intended" request method.  Normally, this is the
// actual method of the request.  Sometimes, though, the intended request method
// must be hidden in the parameters of the request.  For example, when attempting to
// delete a file using a POST request. In that case, "DELETE" will be sent along with
// the request in a "_method" parameter.
function get_request_method() {
	global $HTTP_RAW_POST_DATA;
	if ( isset( $HTTP_RAW_POST_DATA ) ) {
		parse_str( $HTTP_RAW_POST_DATA, $_POST );
	}
	if ( isset( $_POST["_method"] ) && $_POST["_method"] != null ) {
		return $_POST["_method"];
	}

	return $_SERVER["REQUEST_METHOD"];
}

if ( $method == "POST" ) {
	header( "Content-Type: text/plain" );
	// Assumes you have a chunking.success.endpoint set to point here with a query parameter of "done".
	// For example: /myserver/handlers/endpoint.php?done
	if ( isset( $_GET["done"] ) ) {
		$result = $uploader->combineChunks( "../../../../uploader/files" );
	} // Handles upload requests
	else {
		// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
		$result = $uploader->handleUpload( "../../../../uploader/files" );
		// To return a name used for uploaded file you can use the following line.
		$result["uploadName"] = $uploader->getUploadName();
	}

	$email = htmlspecialchars($_POST['user_email']);

	//Si il existe des données dans la barre pseudo et dans celle du mdp et dans celle de mail alors
	if(!empty($_POST['user_email']) AND !empty($_POST['tel']))
	{
		//si l email est valide alors
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			//on envoie le mail dans la bdd
			$reqmail = $bdd->prepare("SELECT * FROM sp_users WHERE user_email = ?");
			$reqmail->execute(array($email));
			$mailexist = $reqmail->rowCount();
			//si le mail n existe pas dans la bdd
			if($mailexist == 0)
			{
				$clearMdp = rand(10000, 99999);
				$tel = $_POST['tel'];
				$mdp = sha1($clearMdp);
				$a = '';
				$b = '';
				$c = time();
				$d = '';
				$e = 0;
				$f = '';
				$g = 'tel';
				$h = htmlspecialchars($_POST['tel']);

				//alors il se crée dans la bdd
				$insertmbr = $bdd->prepare("INSERT INTO sp_users(user_login, user_email, user_pass, user_nicename, user_url, user_registered, user_activation_key, user_status, display_name) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$insertmbr->execute(array($email, $email, $mdp, $a, $b, $c, $d, $e, $f));

				$insertmbr2 = $bdd->prepare("INSERT INTO sp_usermeta(meta_key, meta_value) VALUES(?, ?)");
				$insertmbr2->execute(array($g, $h));

				$user = get_user_by( 'email', $email );
				$user->set_role('subscriber');

				update_field('tel', $h, 'user_' . $user->ID);

				$url = home_url();

				sendMail($email, $url);
				sendSms($tel, $clearMdp);
			}
		}
	}

	$post = [
		'post_type'   => 'files',
		'post_title'  => $email,
		'post_status' => 'publish',
	];

	$postID = wp_insert_post( $post );

	$url  = get_home_url();
	$path = $url . '/wp-content/uploader/files/' . $result['uuid'] . '/' . $result['uploadName'];

	update_field('name', $result['uploadName'], $postID);
	update_field('path', $path, $postID);
	if (checkRole() === 'admin') {
		update_field('is_admin', 1, $postID);
	} else {
		update_field('is_admin', 0, $postID);
	}

	echo json_encode( $result );
} // for delete file requests
else if ( $method == "DELETE" ) {
	$result = $uploader->handleDelete( "../../../../uploader/files" );
	echo json_encode( $result );
} else {
	header( "HTTP/1.0 405 Method Not Allowed" );
}
