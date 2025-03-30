<?php
require 'vendor/autoload.php';

use Google\Client;
use Google\Service\Drive;

function subirArchivoAGoogleDrive($rutaArchivo, $nombreArchivo) {
    $client = new Client();
    $client->setAuthConfig('credenciales.json'); // Asegúrate de que el archivo está en la misma carpeta
    $client->addScope(Drive::DRIVE_FILE);

    $service = new Drive($client);

    $file = new Drive\DriveFile();
    $file->setName($nombreArchivo);
    $file->setParents(["1k3gWuIPc31SIB2A0FGoBuh_SX_AAwbyJ"]); // ID de tu carpeta en Drive

    $content = file_get_contents($rutaArchivo);
    $resultado = $service->files->create($file, [
        'data' => $content,
        'mimeType' => mime_content_type($rutaArchivo),
        'uploadType' => 'multipart'
    ]);

    return $resultado->id;
}

// 🔹 Crear un archivo de prueba
$file_test = 'prueba.txt';
file_put_contents($file_test, "Este es un archivo de prueba para Google Drive");

// 🔹 Probar la subida con el archivo de prueba
$archivoId = subirArchivoAGoogleDrive($file_test, 'archivo_prueba.txt');

if ($archivoId) {
    echo "✅ Archivo subido con éxito. ID: " . $archivoId;
} else {
    echo "❌ Error al subir el archivo.";
}
?>
