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
function sendMail($email, $url)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.sendinblue.com/v3/smtp/email',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Content-Type: application/json',
            'api-key: '. SENDINBLUE_APIKEY .'',
        ],
        CURLOPT_POSTFIELDS => '{"to":[{"name":"sigma-picture","email":"' . $email . '"}],"params":{"URL":"' . $url . '"},"sender":{"name":"sigma-picture","email":"footix@pronobar.fr"},"replyTo":{"email":"footix@pronobar.fr","name":"sigma-picture"},"templateId":7}',
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo 'cURL Error #:' . $err;
    } else {
    }
}