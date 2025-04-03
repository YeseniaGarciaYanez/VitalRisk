<?php
require_once __DIR__ . '/vendor/autoload.php';

try {
    $client = new Google_Client();
    echo "Google_Client se ha instanciado correctamente.";
} catch (Exception $e) {
    echo "Error al instanciar Google_Client: " . $e->getMessage();
}
?>
