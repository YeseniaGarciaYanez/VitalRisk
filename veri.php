<?php
require 'vendor/autoload.php';

use Google\Client;

$client = new Client();
$client->setAuthConfig('credenciales.json');
$client->addScope('https://www.googleapis.com/auth/drive.file');

try {
    $token = $client->fetchAccessTokenWithAssertion();
    if (isset($token['error'])) {
        throw new Exception("Error: " . $token['error_description']);
    }
    echo "✅ Autenticación exitosa. Token generado correctamente.";
} catch (Exception $e) {
    echo "❌ Error en la autenticación: " . $e->getMessage();
}
?>
