<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Mantenimiento - VitalRisk</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos consistentes con tu dashboard */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        .maintenance-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 20px;
        }
        
        .maintenance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            background-color: #2a7fba;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .maintenance-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        
        .filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .filter-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <!-- Sidebar (idéntico a tu dashboard) -->
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
        <!-- Header (idéntico a tu dashboard) -->
        <div class="header">
            <div class="header-left">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Cliente</h1>
            </div>
            <div class="header-right">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Usuario</span>
                </div>
            </div>
        </div>

        <!-- Contenido específico de historial -->
        <div class="content">
            <div class="maintenance-container">
                <div class="maintenance-header">
                    <h2><i class="fas fa-history"></i> Historial de Mantenimientos</h2>
                    <div class="filter-bar">
                        <select class="filter-select">
                            <option>Últimos 3 meses</option>
                            <option>Últimos 6 meses</option>
                            <option>Este año</option>
                            <option>Todos los registros</option>
                        </select>
                        <select class="filter-select">
                            <option>Todos los equipos</option>
                            <option>Resonador Magnético</option>
                            <option>Monitor de Signos</option>
                            <option>Bomba de Infusión</option>
                        </select>
                    </div>
                </div>
                
                <!-- Tarjeta de ejemplo 1 -->
                <div class="maintenance-card">
                    <h3>Resonador Magnético <span class="status-badge status-completed">Completado</span></h3>
                    <p><strong>Fecha:</strong> 15/05/2023</p>
                    <p><strong>Técnico:</strong> Carlos Mendoza</p>
                    <p><strong>Descripción:</strong> Reemplazo de componentes electrónicos y calibración</p>
                    <button class="btn" style="margin-top: 10px;">
                        <i class="fas fa-file-pdf"></i> Descargar Reporte
                    </button>
                </div>
                
                <!-- Tarjeta de ejemplo 2 -->
                <div class="maintenance-card">
                    <h3>Monitor de Signos Vitales <span class="status-badge status-cancelled">Cancelado</span></h3>
                    <p><strong>Fecha:</strong> 10/04/2023</p>
                    <p><strong>Técnico:</strong> Laura Fernández</p>
                    <p><strong>Descripción:</strong> Mantenimiento preventivo (cancelado por falta de repuestos)</p>
                </div>
                
                <!-- Tarjeta de ejemplo 3 -->
                <div class="maintenance-card">
                    <h3>Bomba de Infusión <span class="status-badge status-completed">Completado</span></h3>
                    <p><strong>Fecha:</strong> 02/03/2023</p>
                    <p><strong>Técnico:</strong> Roberto Jiménez</p>
                    <p><strong>Descripción:</strong> Reparación del sistema de flujo y actualización de firmware</p>
                    <button class="btn" style="margin-top: 10px;">
                        <i class="fas fa-file-pdf"></i> Descargar Reporte
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menú móvil (igual que tu dashboard)
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Simulación de filtrado
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                alert('Filtrando historial... (simulación)');
            });
        });
    </script>
</body>
</html>