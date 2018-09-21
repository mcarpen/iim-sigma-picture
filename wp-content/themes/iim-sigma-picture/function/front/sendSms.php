<?php
include __DIR__ . "/../../../../../wp-load.php";
/**
 * @param $tel
 * @param $barName
 * @param $cheersLink
 * @param $voteID
 * @param $email
 *
 * Used to send transactionnal SMS when someone wins
 */
function sendSms($tel, $barName, $cheersLink, $voteID, $email)
{
	$curl = curl_init();
	$smsContent = 'Bravo, score exact !!! ';
	$smsContent .= 'C’est le moment de profiter de ta 3e mi-temps. ';
	$smsContent .= 'Clique ici pour récupérer ta bière -> ' . $cheersLink . ' !';
	curl_setopt_array($curl, [
		CURLOPT_URL            => 'https://api.sendinblue.com/v3/transactionalSMS/sms',
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
		CURLOPT_POSTFIELDS     => '{"type":"transactional","sender":"Pronobar","recipient":"' . $tel . '","content":"' . $smsContent . '"}',
	]);
	$response = curl_exec($curl);
	$err      = curl_error($curl);
	curl_close($curl);
	if ($err) {
		$err = 'cURL Error #:' . $err;
		update_field('etat_transactionnel', 'tel_error', $voteID);
	} else {
		echo $response;
		update_field('etat_transactionnel', 'tel_success', $voteID);
	}
}