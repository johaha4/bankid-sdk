<?php

require_once __DIR__ . "/../vendor/autoload.php";

use BankID\SDK\ClientAsynchronous;
use BankID\SDK\Configuration\Config;
use BankID\SDK\Requests\Payload\AuthenticationPayload;
use BankID\SDK\Responses\DTO\AuthenticationResponse;
use Doctrine\Common\Annotations\AnnotationRegistry;
use function GuzzleHttp\Promise\unwrap;

AnnotationRegistry::registerLoader('class_exists');

// Example certificate for test environment.
$configuration = new Config(__DIR__ . '/../rsc/certificates/cert.pem');
$client = new ClientAsynchronous($configuration);

$promises[] = $client->authenticate(new AuthenticationPayload('<PERSONAL NUMBER>', '<IP ADDRESS>'));
$promises[] = $client->authenticate(new AuthenticationPayload('<PERSONAL NUMBER>', '<IP ADDRESS>'));

// Parallel requests, retrieve all threads
foreach (unwrap($promises) as $result) {
    /**
     * @var AuthenticationResponse $result
     */
    var_dump($result->isSuccess());
}
