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
function sendSms($tel, $clearMDP)
{
	$curl = curl_init();
	$smsContent = 'Mot de pase pour acceder a la plateforme sigma picture :';
	$smsContent .= ' '. $clearMDP .'';
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
            'api-key: '. SENDINBLUE_APIKEY .'',
		],
		CURLOPT_POSTFIELDS     => '{"type":"transactional","sender":"sigma picture","recipient":"' . $tel . '","content":"' . $smsContent . '"}',
	]);
	$response = curl_exec($curl);
	$err      = curl_error($curl);
	curl_close($curl);
	if ($err) {
		echo $err = 'cURL Error #:' . $err;
	} else {
		}
}