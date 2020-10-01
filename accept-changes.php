<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use \Ovh\Api;

$applicationKey = $_ENV['OVH_API_APP_KEY'];
$applicationSecret = $_ENV['OVH_API_SECRET'];
$consumer_key = $_ENV['OVH_API_CONSUMER_KEY'];
$endpoint = 'ovh-eu';

$ovh = new Api( $applicationKey,
                $applicationSecret,
                $endpoint,
                $consumer_key
);

$csv = array_map('str_getcsv', file('tokens.csv')); 

foreach ($csv as $row) {
    $id = $row[0];
    $token = $row[1];
    $result = $ovh->post('/me/task/contactChange/'.$id.'/accept', array(
        'token' => $token, 
    ));
    print_r( $result );
}

?>