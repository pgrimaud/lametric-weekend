<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/parameters.php';

Sentry\init(['dsn' => $config['sentry_key']]);

header("Content-Type: application/json");

try {

    $parameters = array_map('htmlspecialchars', $_GET);
    $language   = isset($_GET['lang']) ? strtolower($_GET['lang']) : 'english';

    $weekend = new Weekend\Api();
    $data    = $weekend->fetch();

    $translate = new Weekend\Translate($language);
    $sentence1 = $translate->getSentence1();
    $sentence2 = $translate->getSentence2($data);

    $response = new Weekend\Response();
    echo $response->returnResponse($sentence1, $sentence2);

} catch (Exception $exception) {

    $response = new Weekend\Response();
    echo $response->returnError();

}
