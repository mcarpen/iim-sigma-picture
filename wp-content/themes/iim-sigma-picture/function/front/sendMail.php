<?php
include __DIR__ . "/../../../../../wp-load.php";
/**
 * @param      $email
 * @param      $barName
 * @param      $cheersLink
 * @param      $voteID
 * @param bool $lost
 *
 * Used to send transactionnal email when someone wins
 */
function sendMail($email, $barName, $cheersLink, $voteID, $lost = false)
{
	if ($lost) {
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL            => 'https://api.sendinblue.com/v3/smtp/email',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'POST',
			CURLOPT_HTTPHEADER     => [
				'Accept: application/json',
				'Content-Type: application/json',
				'api-key: API-KEY',
			],
			CURLOPT_POSTFIELDS     => '{"to":[{"name":"Footix","email":"' . $email . '"}],"sender":{"name":"Pronobar","email":"footix@pronobar.fr"},"replyTo":{"email":"footix@pronobar.fr","name":"Pronobar"},"templateId":4}',
		]);
		$response = curl_exec($curl);
		$err      = curl_error($curl);
		curl_close($curl);
	} else {
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL            => 'https://api.sendinblue.com/v3/smtp/email',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'POST',
			CURLOPT_HTTPHEADER     => [
				'Accept: application/json',
				'Content-Type: application/json',
				'api-key: API-KEY',
			],
			CURLOPT_POSTFIELDS     => '{"to":[{"name":"Footix","email":"' . $email . '"}],"params":{"BAR_NAME":"' . $barName . '","CHEERS_LINK":"' . $cheersLink . '"},"sender":{"name":"Pronobar","email":"footix@pronobar.fr"},"replyTo":{"email":"footix@pronobar.fr","name":"Pronobar"},"templateId":2}',
		]);
		$response = curl_exec($curl);
		$err      = curl_error($curl);
		curl_close($curl);
	}
	if ($err) {
		echo 'cURL Error #:' . $err;
		update_field('etat_transactionnel', 'email_error', $voteID);
		$message = 'Erreur MAIL transactionnel : ' . $err . ' / ID Vote : ' . $voteID . '';
		slackMessage($message);
	} else {
		echo $response;
		update_field('etat_transactionnel', 'email_success', $voteID);
	}
}