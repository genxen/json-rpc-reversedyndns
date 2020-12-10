<?php

require_once '/home/dyndns/api_dev/json-rpc-dyndns/vendor/autoload.php';

use Datto\JsonRpc;
use Datto\JsonRpc\Simple;

$evaluator = new Simple\Evaluator(new Simple\Mapper('dyndns\\Api\\Endpoint\\'));
$server = new JsonRpc\Server($evaluator);

header('Content-Type: application/json');
$message = file_get_contents('php://input');

echo $server->reply($message);
