<?php
require_once 'vendor/autoload.php';

use Google_Client;
use Google_Service_Drive;

// Configurar el cliente de Google
$client = new Google_Client();
$client->setAuthConfig('C:\\xampp\\htdocs\\credenciales.json');
$client->addScope(Google_Service_Drive::DRIVE_FILE);

// Inicializar el servicio de Google Drive
$service = new Google_Service_Drive($client);

// Configurar los metadatos del archivo
$fileMetadata = new Google_Service_Drive_DriveFile(array(
    'name' => 'reporte_mantenimiento.pdf'
));

// Leer el contenido del PDF
$content = file_get_contents('reporte_mantenimiento.pdf');

// Subir el archivo a Google Drive
$file = $service->files->create($fileMetadata, array(
    'data' => $content,
    'mimeType' => 'application/pdf',
    'uploadType' => 'multipart',
    'fields' => 'id'
));

echo "Archivo subido exitosamente. ID del archivo: " . $file->id;
?>
