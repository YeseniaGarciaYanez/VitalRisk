<?php
require 'vendor/autoload.php';
require_once 'vendor/autoload.php'; // Carga las librerías necesarias

use Google\Client;
use Google\Service\Drive;
use Dompdf\Dompdf;
use Dompdf\Options;

function generarPDF($nombreArchivo) {
    // Configurar opciones de Dompdf
    $options = new Options();
    $options->set('defaultFont', 'Arial');

    // Crear instancia de Dompdf
    $dompdf = new Dompdf($options);

    // Contenido del PDF
    $html = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            h1 { color: #333; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        </style>
    </head>
    <body>
        <h1>Reporte de Mantenimiento</h1>
        <p>Fecha: ' . date("d/m/Y") . '</p>
        <table>
            <tr>
                <th>Equipo Médico</th>
                <th>Fecha de Mantenimiento</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td>Equipo 1</td>
                <td>01/04/2025</td>
                <td>Aprobado</td>
            </tr>
        </table>
    </body>
    </html>';

    // Cargar HTML en Dompdf
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Guardar el PDF en el servidor
    file_put_contents($nombreArchivo, $dompdf->output());
}

// 🔹 **Función para subir archivo a Google Drive**
function subirArchivoAGoogleDrive($rutaArchivo, $nombreArchivo) {
    $client = new Client();
    $client->setAuthConfig('credenciales.json'); // Archivo de credenciales de Google
    $client->addScope(Drive::DRIVE_FILE);
    $client->setAccessType('offline');

    $service = new Drive($client);

    // Configurar metadatos del archivo
    $fileMetadata = new Drive\DriveFile();
    $fileMetadata->setName($nombreArchivo);
    $fileMetadata->setParents(["1k3gWuIPc31SIB2A0FGoBuh_SX_AAwbyJ"]); // ID de la carpeta de destino

    // Leer el contenido del archivo
    $content = file_get_contents($rutaArchivo);

    // Intentar subir el archivo
    try {
        $file = $service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($rutaArchivo),
            'uploadType' => 'multipart'
        ]);

        return $file->id;
    } catch (Exception $e) {
        echo "❌ Error al subir el archivo: " . $e->getMessage();
        return null;
    }
}

// 🔹 **Generar PDF y subirlo automáticamente**
$nombreArchivoPDF = 'reporte_mantenimiento.pdf';
generarPDF($nombreArchivoPDF);
$archivoId = subirArchivoAGoogleDrive($nombreArchivoPDF, 'Reporte_Mantenimiento.pdf');

if ($archivoId) {
    echo "✅ PDF subido con éxito. ID: " . $archivoId;
} else {
    echo "❌ Error al subir el PDF.";
}
?>
