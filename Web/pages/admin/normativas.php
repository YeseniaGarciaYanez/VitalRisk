<?php
// Obtener datos de la API de normativas
$api_url = "https://sheet2api.com/v1/OOb2tXvPROOB/normativas";
$normativas = json_decode(file_get_contents($api_url), true) ?: [];

// Funciones de ayuda
function formatYear($year) {
    return is_numeric($year) ? $year : 'No especificado';
}

// Filtrar solo normativas vigentes
$normativas_vigentes = array_filter($normativas, function($item) {
    return ($item['Vigencia'] ?? '') === 'Vigente';
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normativas - VitalRisk</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/normativas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../images/logovital2.png" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="mantenimiento.php"><i class="fas fa-tools"></i> Maintenance</a></li>
            <li><a href="historial.php"><i class="fas fa-history"></i> History</a></li>
            <li class="active"><a href="normativas.php"><i class="fas fa-file-alt"></i> Normativas</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Normativas Vigentes</h1>
            </div>
            <div class="header-right">
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Usuario</span>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="content">
            <div class="normativas-container">
                <!-- Barra de búsqueda y filtros -->
                <div class="search-container">
                    <input type="text" class="search-bar" id="searchInput" placeholder="Buscar por palabra clave...">
                    <select class="filter-select" id="yearFilter">
                        <option value="all">Todas las fechas</option>
                        <?php
                        $years = array_unique(array_column($normativas_vigentes, 'Fecha de Publicación'));
                        rsort($years);
                        foreach ($years as $year):
                            if (is_numeric($year)):
                        ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                        <?php endif; endforeach; ?>
                    </select>
                </div>
                
                <!-- Listado de normativas -->
                <div class="normativas-list" id="normativasList">
                    <?php foreach ($normativas_vigentes as $normativa): ?>
                        <div class="normativa-card" 
                             data-keywords="<?= strtolower(htmlspecialchars($normativa['Título'] . ' ' . $normativa['Descripción'])) ?>"
                             data-year="<?= htmlspecialchars($normativa['Fecha de Publicación']) ?>">
                            <h3><?= htmlspecialchars($normativa['Título']) ?></h3>
                            <div style="margin: 8px 0;">
                                <span class="vigente-badge">VIGENTE</span>
                                <span style="margin-left: 10px; color: #6c757d;">
                                    <?= htmlspecialchars($normativa['Código']) ?> - <?= formatYear($normativa['Fecha de Publicación']) ?>
                                </span>
                            </div>
                            <p><?= htmlspecialchars($normativa['Descripción']) ?></p>
                            <div style="margin-top: 10px; color: #6c757d; font-size: 0.9em;">
                                <strong>Institución:</strong> <?= htmlspecialchars($normativa['Institución Emisora'] ?? 'No especificada') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if (empty($normativas_vigentes)): ?>
                        <p>No se encontraron normativas vigentes.</p>
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
        
        // Menú móvil
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>