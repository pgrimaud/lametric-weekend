<?php
require __DIR__ . '/vendor/autoload.php';

header("Content-Type: application/json");

try {

    $parameters = array_map('htmlspecialchars', $_GET);
    $language = isset($_GET['lang']) ? strtolower($_GET['lang']) : 'english';

    $weekend = new Weekend\Api();
    $data = $weekend->fetch();

    $translate = new Weekend\Translate($language);
    $sentence = $translate->getTranslation($data);

    $response = new Weekend\Response();
    echo $response->returnResponse($sentence);

} Catch (Exception $exception) {

    $response = new Weekend\Response();
    echo $response->returnError();

}
