<?php
// Incluye el autoload generado por Composer
require_once '../vendor/autoload.php';


use Dompdf\Dompdf;

// 1. Crear una instancia de Dompdf
$dompdf = new Dompdf();

// 2. Preparar el contenido HTML dinámicamente (puedes adaptarlo a tus datos)
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
    <h1>Reporte de Mantenimiento Preventivo</h1>
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

// 3. Cargar el contenido HTML
$dompdf->loadHtml($html);

// 4. Configurar tamaño y orientación del papel
$dompdf->setPaper('A4', 'portrait');

// 5. Renderizar el HTML como PDF
$dompdf->render();

// 6. Guardar el PDF en disco para después subirlo a Google Drive
$output = $dompdf->output();
$pdfPath = 'reporte_mantenimiento.pdf';
file_put_contents($pdfPath, $output);

echo "PDF generado y guardado en: $pdfPath";
?>