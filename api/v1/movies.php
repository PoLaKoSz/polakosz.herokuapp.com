<?php

error_reporting(0);

require_once 'DB/select.php';
require_once 'url_parser.php';

$connectionDetails = [
    'host'      => '127.0.0.1',
    'username'  => 'root',
    'password'  => '',
    'db_name'   => 'id2322644_polakosz',
    'charset'   => 'utf8',
    'tableName' => 'movies',
];

$maxResultLimit = 10;

try {
    $details = new UrlParser($_GET, $maxResultLimit);

    $select = new Select($connectionDetails, $details->resultArray, true);
    echo json_encode( $select->getResults(), JSON_UNESCAPED_UNICODE );
} catch(Exception $e) {
    echo json_encode($error =  [
                        'response' => [
                            'message' => $e->getMessage(),
                            'status' => 'error',
                        ]
                    ]);
}

?>