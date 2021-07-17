<?php

// Cache file path for requested events
$LastResponse = "/tmp/LastResponse.json";

// Request Last 100 events from UNMS API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://<YOUR_UNMS_URL>/nms/api/v2.1/logs?count=100&page=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "X-Auth-Token: <YOUR_UNMS_API_TOKEN>"
));
$response = curl_exec($ch);
curl_close($ch);


$new_json = json_decode($response,true);
// Read last cached events from cache file
$last_json = json_decode(file_get_contents($LastResponse), true);

// Find first event id  from cache file
$last_id = $last_json['items'][0]['id'];

// Find new events
$i = 0;
foreach($new_json['items'] as $value){
    if($last_id == $value['id']){
	echo "No new events!\n";
	break;
    }else{
	echo "New event found!\n";
	echo $value['message']."\n";
	$telegram_api_curl = curl_init();
	curl_setopt($telegram_api_curl, CURLOPT_URL, "https://api.telegram.org/bot<TELEGROM_BOT_API_KEY>/sendMessage?chat_id=<TELEGRAM_CHAT_ID>&text=\xE2\x9A\xA0 UNMS - ".$value['message']);
	curl_setopt($telegram_api_curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($telegram_api_curl, CURLOPT_HEADER, FALSE);
	curl_setopt($telegram_api_curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($telegram_api_curl, CURLOPT_SSL_VERIFYPEER, 0);
	$telegram_api_curl_result = curl_exec($telegram_api_curl);
	curl_close($telegram_api_curl);
	echo $telegram_api_curl_result."\n";
	$i++;
    }
}

if ($i != 0) {
	$ac = fopen($LastResponse, "w+");
	fwrite($ac, print_r($response,TRUE));
	fclose($ac);
}

?>
