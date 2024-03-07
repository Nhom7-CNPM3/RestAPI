<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use vennv\vapm\System;

$url = "http://localhost:8080/hellojs";

System::fetch($url)->then(function($data) {
    $json = json_decode($data->getBody());
    echo $json->message;
});