<?php
require_once '../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Google\Client;
use Google\Service\Drive;

// =====================
// 1. Recibir datos del formulario
// =====================
$equipo          = $_POST['equipo'];
$equipo_id       = $_POST['equipo_id'];
$fecha           = date('Y-m-d');
$tecnico         = $_POST['tecnico'];
$ubicacion       = $_POST['ubicacion'];
$detalles        = $_POST['detalles'];
$observaciones   = $_POST['observaciones'];
$recomendaciones = $_POST['recomendaciones'];

// =====================
// 2. Crear contenido HTML del PDF
// =====================
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Mantenimiento</title>
    
    <!-- Importar la tipografía Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 30px;
            color: #333;
            background-color: #f9f9f9;
        }
        
        h1, h2 {
            color: #1a73e8;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        h1 {
            border-bottom: 2px solid #1a73e8;
            padding-bottom: 10px;
        }

        .logo {
            width: 180px;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section p {
            font-size: 14px;
            line-height: 1.6;
        }

        .section strong {
            color: #1a73e8;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td, th {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 0;
        }

        .link {
            color: #1a73e8;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../logo/vitarisk.png" alt="Logo" style="border-radius: 50%;">
            <h2></h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboardAdmin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="equipment.php"><i class="fas fa-tools"></i> Equipamiento</a></li>
            <li><a href="hospital.php"><i class="fas fa-history"></i> Hospital</a></li>
            <li><a href="../../logout.php" onclick="return confirm('¿Estás seguro de cerrar sesión?')"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>
    
    <h1>Reporte de Mantenimiento</h1>
    <p><strong>Fecha de reporte:</strong> <?= $fecha ?></p>

    <!-- Datos del equipo -->
    <div class="section">
        <h2>Datos del Equipo</h2>
        <p><strong>Nombre del equipo:</strong> <?= htmlspecialchars($equipo) ?></p>
        <p><strong>ID del equipo:</strong> <?= htmlspecialchars($equipo_id) ?></p>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($ubicacion) ?></p>
    </div>

    <!-- Responsable del mantenimiento -->
    <div class="section">
        <h2>Responsable del Mantenimiento</h2>
        <p><strong>Técnico encargado:</strong> <?= htmlspecialchars($tecnico) ?></p>
    </div>

    <!-- Detalles del mantenimiento -->
    <div class="section">
        <h2>Detalles del Mantenimiento</h2>
        <p><?= nl2br(htmlspecialchars($detalles)) ?></p>
    </div>

    <!-- Observaciones -->
    <div class="section">
        <h2>Observaciones</h2>
        <p><?= nl2br(htmlspecialchars($observaciones)) ?></p>
    </div>

    <!-- Recomendaciones -->
    <div class="section">
        <h2>Recomendaciones</h2>
        <p><?= nl2br(htmlspecialchars($recomendaciones)) ?></p>
    </div>

    <!-- Tabla con un resumen de los datos -->
    <h2>Resumen</h2>
    <table>
        <tr>
            <th>Campo</th>
            <th>Detalle</th>
        </tr>
        <tr>
            <td>Equipo</td>
            <td><?= htmlspecialchars($equipo) ?></td>
        </tr>
        <tr>
            <td>ID del Equipo</td>
            <td><?= htmlspecialchars($equipo_id) ?></td>
        </tr>
        <tr>
            <td>Ubicación</td>
            <td><?= htmlspecialchars($ubicacion) ?></td>
        </tr>
        <tr>
            <td>Técnico</td>
            <td><?= htmlspecialchars($tecnico) ?></td>
        </tr>
        <tr>
            <td>Fecha</td>
            <td><?= $fecha ?></td>
        </tr>
    </table>

    <!-- Información adicional (si es necesario) -->
    <div class="footer">
        <p>Reporte generado por VitalRisk - Sistema de Mantenimiento de Equipos Médicos</p>
        <p>Para más información, visite nuestro <a href="https://www.vitalrisk.com" class="link" target="_blank">sitio web</a>.</p>
    </div>
</body>
</html>
<?php
$html = ob_get_clean();

// =====================
// 3. Generar PDF con DomPDF
// =====================
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$pdfOutput = $dompdf->output();
$tempFilePath = 'temp_reporte.pdf';
file_put_contents($tempFilePath, $pdfOutput);

// =====================
// 4. Subir PDF a Google Drive
// =====================
$client = new Client();
$client->setApplicationName('VitalRisk - Subida de Reportes');
$client->setScopes(Drive::DRIVE_FILE);
$client->setAuthConfig('C:/xampp/htdocs/credencial.json');
$client->setAccessType('offline');

$driveService = new Drive($client);

// ID de carpeta en Google Drive (opcional)
$folderId = '1k3gWuIPc31SIB2A0FGoBuh_SX_AAwbyJ'; // Reemplaza con tu carpeta si la usas

$fileMetadata = new Drive\DriveFile([
    'name' => 'Reporte_Mantenimiento_' . date('Ymd_His') . '.pdf',
    'parents' => [$folderId]
]);

try {
    $file = $driveService->files->create($fileMetadata, [
        'data' => file_get_contents($tempFilePath),
        'mimeType' => 'application/pdf',
        'uploadType' => 'multipart',
        'fields' => 'id, webViewLink'
    ]);

    echo "<h3>✅ Reporte generado correctamente</h3>";
    echo "<p>📄 <a href='{$file->webViewLink}' target='_blank'>Ver Reporte en Google Drive</a></p>";

} catch (Exception $e) {
    echo "❌ Error al subir el PDF: " . $e->getMessage();
}

unlink($tempFilePath);
?>
