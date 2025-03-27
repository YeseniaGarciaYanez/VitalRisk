<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mantenimiento - VitalRisk</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Los mismos estilos que en mantenimiento.php */
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
            max-width: 800px;
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
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <!-- Sidebar (igual que tu dashboard) -->
    <div class="sidebar">
        <div<img src="../../images/logovital2.png" alt="Logo" style="border-radius: 50%;">
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
        <!-- Header (igual que tu dashboard) -->
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
                    <span class="notification-badge">5</span>
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Usuario</span>
                </div>
            </div>
        </div>

        <!-- Contenido del formulario -->
        <div class="content">
            <div class="maintenance-container">
                <div class="maintenance-header">
                    <h2><i class="fas fa-plus-circle"></i> Nuevo Mantenimiento</h2>
                    <a href="mantenimiento.php" class="btn">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                
                <form id="maintenanceForm">
                    <div class="form-group">
                        <label for="equipment">Equipo Médico</label>
                        <select id="equipment" required>
                            <option value="">Seleccione un equipo</option>
                            <option value="1">Resonador Magnético</option>
                            <option value="2">Monitor de Signos Vitales</option>
                            <option value="3">Bomba de Infusión</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Fecha Programada</label>
                        <input type="date" id="date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Descripción del Problema</label>
                        <textarea id="description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="attachments">Adjuntar Archivos (Opcional)</label>
                        <input type="file" id="attachments" multiple>
                    </div>
                    
                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i> Enviar Solicitud
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Menú móvil (igual que tu dashboard)
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Manejo del formulario
        document.getElementById('maintenanceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Mantenimiento registrado exitosamente!');
            window.location.href = 'mantenimiento.php';
        });
    </script>
</body>
</html>