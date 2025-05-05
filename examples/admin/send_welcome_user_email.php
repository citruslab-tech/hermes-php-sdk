<?php
require 'vendor/autoload.php';

use HermesSdk\HttpApiClient;
use HermesSdk\Models\Scolaris\Tenant;

$hubApiUrl = 'http://localhost:8103';

$hubApiClient = new HttpApiClient();
$hubApiClient->setBaseUrl($hubApiUrl);

$keyResponse = $hubApiClient->get('key');
$apiKey = $keyResponse['key'];

$hubClient = new HermesSdk\HermesClient($apiKey, $hubApiUrl);

$destination = 'demo@email.com';
$userName = 'Demo User';
$tenant = new Tenant('Demo Tenant', 'demo-tenant');
$email = $hubClient->scolaris()->sendWelcomeUserMail($destination, $userName, $tenant);

print_r($email->toArray());
