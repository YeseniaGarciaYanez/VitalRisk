<?php
// URL de la API
$apiUrl = "https://sheet2api.com/v1/OOb2tXvPROOB/ola";

// Obtener datos de la API
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// Filtrar por estado si se pasa por GET
$estadoFiltro = isset($_GET['estado']) ? $_GET['estado'] : '';

// Recopilar estados únicos para el dropdown
$estadosDisponibles = [];
foreach ($data as $item) {
    if (isset($item['ESTADO']) && !in_array($item['ESTADO'], $estadosDisponibles)) {
        $estadosDisponibles[] = $item['ESTADO'];
    }
}

// Si se ha seleccionado un estado, filtrar los hospitales
if ($estadoFiltro != '') {
    $dataFiltrada = array_filter($data, function($item) use ($estadoFiltro) {
        return isset($item['ESTADO']) && $item['ESTADO'] === $estadoFiltro;
    });
} else {
    $dataFiltrada = $data;
}

// Preparar los datos para pasar a JavaScript (asegurarse de tener lat y lng en cada registro)
$hospitales = [];
foreach ($dataFiltrada as $item) {
    // Se asume que la API incluye campos 'lat' y 'lng'
    if (isset($item['lat']) && isset($item['lng'])) {
        $hospitales[] = [
            'nombre' => $item['NOMBRE DE LA INSTITUCION'] ?? '',
            'clues'  => $item['CLUES'] ?? '',
            'clave'  => $item['CLAVE DE LA INSTITUCION'] ?? '',
            'estado' => $item['ESTADO'] ?? '',
            'lat'    => floatval($item['lat']),
            'lng'    => floatval($item['lng'])
        ];
    }
}

// Convertir a JSON para usar en JavaScript
$hospitalesJSON = json_encode($hospitales);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa de Hospitales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        .filtro {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Mapa de Hospitales</h1>

    <!-- Formulario para filtrar por estado -->
    <div class="filtro">
        <form method="GET" action="mapa.php">
            <label for="estado">Filtrar por estado:</label>
            <select name="estado" id="estado">
                <option value="">-- Todos --</option>
                <?php foreach ($estadosDisponibles as $estado): ?>
                    <option value="<?php echo htmlspecialchars($estado); ?>" <?php if ($estadoFiltro == $estado) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($estado); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <!-- Contenedor del mapa -->
    <div id="map"></div>

    <!-- Scripts de Leaflet -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inicializar el mapa centrado (puedes ajustar la lat y lng al centro de tu región)
        var map = L.map('map').setView([19.432608, -99.133209], 5); // Centro de México (ejemplo)

        // Capa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Datos de hospitales obtenidos desde PHP
        var hospitales = <?php echo $hospitalesJSON; ?>;

        // Agregar marcadores para cada hospital
        hospitales.forEach(function(hospital) {
            var marker = L.marker([hospital.lat, hospital.lng]).addTo(map);
            var popupContent = "<strong>" + hospital.nombre + "</strong><br>" +
                               "CLUES: " + hospital.clues + "<br>" +
                               "Clave: " + hospital.clave + "<br>" +
                               "Estado: " + hospital.estado;
            marker.bindPopup(popupContent);
        });
    </script>
</body>
</html>
