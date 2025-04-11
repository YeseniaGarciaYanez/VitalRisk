<?php
// Obtener datos de la API de normativas
$api_url = "https://sheet2api.com/v1/OOb2tXvPROOB/normativas"; // Define la URL de la API que contiene los datos de las normativas.
$normativas = json_decode(file_get_contents($api_url), true) ?: []; // Obtiene el contenido de la API, lo decodifica de JSON a un array asociativo, y si falla, asigna un array vacío.

// Funciones de ayuda
function formatYear($year) { // Define una función para formatear el año de publicación.
    return is_numeric($year) ? $year : 'No especificado'; // Si el año es numérico, lo devuelve; de lo contrario, devuelve 'No especificado'.
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial--scale=1.0">
    <title>Normativas - VitalRisk</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/normativas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
            * {
      font-family: 'Montserrat', sans-serif;
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../Logo/vitarisk.png" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboardCliente.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="active"><a href="normativas.php"><i class="fas fa-file-alt"></i> Normativas</a></li>
            <li><a href="../../logout.php" onclick="return confirm('¿Estás seguro de cerrar sesión?')"> <i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-left">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Normativas</h1>
            </div>
            <div class="header-right">
                <div class="user-profile">
                    <span>Usuario</span>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="normativas-container">
                <div class="search-container">
                    <input type="text" class="search-bar" id="searchInput" placeholder="Buscar por palabra clave...">
                    <select class="filter-select" id="yearFilter">
                        <option value="all">Todas las fechas</option>
                        <?php
                        $years = array_unique(array_column($normativas, 'Fecha de Publicación')); // Obtiene los años únicos de las normativas.
                        rsort($years); // Ordena los años de forma descendente.
                        foreach ($years as $year): // Itera sobre los años únicos.
                            if (is_numeric($year)): // Verifica si el año es numérico.
                        ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                        <?php endif; endforeach; ?>
                    </select>
                </div>
                
                <div class="normativas-list" id="normativasList">
                    <?php foreach ($normativas as $normativa): ?> 
                        <div class="normativa-card" 
                             data-keywords="<?= strtolower(($normativa['Título'] . ' ' . $normativa['Descripción'])) ?>"
                             data-year="<?=($normativa['Fecha de Publicación']) ?>">
                            <h3><?= ($normativa['Título']) ?></h3>
                            <div style="margin: 8px 0;">
                                <span class="vigente-badge">VIGENTE</span>
                                <span style="margin-left: 10px; color: #6c757d;">
                                    <?=($normativa['Código']) ?> - <?= formatYear($normativa['Fecha de Publicación']) ?>
                                </span>
                            </div>
                            <p><?=($normativa['Descripción']) ?></p>
                            <div style="margin-top: 10px; color: #6c757d; font-size: 0.9em;">
                                <strong>Institución:</strong> <?= ($normativa['Institución Emisora'] ?? 'No especificada') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($normativas)): ?> // Verifica si no hay normativas.
                        <p>No se encontraron normativas.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad de búsqueda
        document.getElementById('searchInput').addEventListener('input', function() {
            filterNormativas();
        });
        
        // Funcionalidad de filtrado por año
        document.getElementById('yearFilter').addEventListener('change', function() {
            filterNormativas();
        });
        
        function filterNormativas() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedYear = document.getElementById('yearFilter').value;
            
            document.querySelectorAll('.normativa-card').forEach(card => {
                const keywords = card.getAttribute('data-keywords');
                const year = card.getAttribute('data-year');
                
                const matchesSearch = searchTerm === '' || keywords.includes(searchTerm);
                const matchesYear = selectedYear === 'all' || year === selectedYear;
                
                card.style.display = (matchesSearch && matchesYear) ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>