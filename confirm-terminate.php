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

// cat mails.eml | grep -e "Cette demande concerne le domaine" -e "confirmTerminate" | cut -d" " -f6 | sed "s;https://www.ovh.com/manager/#/billing/confirmTerminate?id=;;g" | sed 'N;s/,\n/,/' | sed 's/&token=/,/' | cut -d, -f1,3

$csv = array_map('str_getcsv', file('zone-tokens.csv')); 

foreach ($csv as $row) {
    $zoneName = $row[0];
    $token = $row[1];
    $result = $ovh->post('/domain/zone/'.$zoneName.'/confirmTermination', array(
        'commentary' => NULL,
        'futureUse' => 'NOT_REPLACING_SERVICE',
        'reason' => 'NOT_NEEDED_ANYMORE',
        'token' => $token,
    ));
    print_r( $result );
}

?>