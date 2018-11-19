<?php

require_once 'class.total_voice_api.php';

$token = "PUT YOUR TOKEN HERE";
$api = new TotalVoiceStatusAPI($token);
$response = $api->get_status()->send();
print_r($response);


