<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// Inicializar Dompdf
$dompdf = new Dompdf();

// Crea el contenido HTML que se convertirá a PDF
$html = '
    <html>
      <head>
        <meta charset="utf-8">
        <title>Mantenimiento Preventivo</title>
      </head>
      <body>
        <h1>Reporte de Mantenimiento</h1>
        <p>Detalle del mantenimiento preventivo para equipos médicos.</p>
      </body>
    </html>
';

// Cargar el HTML en Dompdf
$dompdf->loadHtml($html);

// Configurar el tamaño y la orientación del papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF a partir del HTML
$dompdf->render();

// Obtener el contenido generado
$output = $dompdf->output();

// Guardar el PDF en un archivo
$pdfFilePath = 'reporte_mantenimiento.pdf';
file_put_contents($pdfFilePath, $output);
?>
