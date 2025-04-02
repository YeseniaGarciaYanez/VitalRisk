<?php
require __DIR__ . '/../vendor/autoload.php';

function subirArchivoAGoogleDrive($archivoPath, $nombreArchivo) {
    $client = new Google\Client();
    $client->setAuthConfig(__DIR__ . '/../credenciales.json');
    $client->addScope(Google\Service\Drive::DRIVE_FILE);

    $service = new Google\Service\Drive($client);

    $fileMetadata = new Google\Service\Drive\DriveFile([
        'name' => $nombreArchivo
    ]);

    $content = file_get_contents($archivoPath);
    $archivo = $service->files->create($fileMetadata, [
        'data' => $content,
        'mimeType' => mime_content_type($archivoPath),
        'uploadType' => 'multipart',
        'fields' => 'id'
    ]);

    return $archivo->id;
}

// Prueba con un archivo de tu PC
$archivoPath = 'reporte_mantenimiento.pdf';  // Asegúrate de que el archivo existe en la misma carpeta
$nombreArchivo = 'Reporte_Subido.pdf';

try {
    $archivoId = subirArchivoAGoogleDrive($archivoPath, $nombreArchivo);
    echo "✅ Archivo subido con éxito. ID: $archivoId";
} catch (Exception $e) {
    echo "❌ Error al subir el archivo: " . $e->getMessage();
}
