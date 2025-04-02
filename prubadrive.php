<?php
require 'vendor/autoload.php';

$client = new Google\Client();
$client->setAuthConfig('credenciales.json');
$client->addScope(Google\Service\Drive::DRIVE);

echo "Autenticación exitosa";
