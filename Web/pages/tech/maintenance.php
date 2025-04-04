<?php
// Ejemplo de arreglo con datos de mantenimientos
$mantenimientos = [
    [
        'hospital'   => 'Hospital General',
        'equipo'     => 'Respirador',
        'fecha'      => '2025-04-10',
        'prioridad'  => 'high',
        'notas'      => 'Revisión de batería y ventilación'
    ],
    [
        'hospital'   => 'Clínica San José',
        'equipo'     => 'Electrocardiógrafo',
        'fecha'      => '2025-04-12',
        'prioridad'  => 'medium',
        'notas'      => 'Actualización de software'
    ],
    [
        'hospital'   => 'Hospital del Norte',
        'equipo'     => 'Máquina de Rayos X',
        'fecha'      => '2025-04-15',
        'prioridad'  => 'high',
        'notas'      => 'Calibración de sensores de imagen'
    ],
    [
        'hospital'   => 'Hospital Santa María',
        'equipo'     => 'Desfibrilador',
        'fecha'      => '2025-04-20',
        'prioridad'  => 'high',
        'notas'      => 'Cambio de electrodos y prueba de descarga'
    ],
    [
        'hospital'   => 'Hospital Universitario',
        'equipo'     => 'Tomógrafo',
        'fecha'      => '2025-04-22',
        'prioridad'  => 'medium',
        'notas'      => 'Inspección del sistema de refrigeración'
    ]
];

// Función para asignar estilo según la prioridad
function getPriorityStyle($prioridad) {
    $colorMap = [
        'high'   => '#d9534f',
        'medium' => '#f0ad4e',
        'low'    => '#5cb85c'
    ];
    return isset($colorMap[$prioridad]) ? $colorMap[$prioridad] : '#000';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mantenimientos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/table.css">
    <style>
        /* Estilos generales */
        .table-container {
            width: 100%;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #1D5E69;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Estilo del selector de prioridad */
        select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Botones de acción */
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        }
        .btn-agregar {
            background-color: #5cb85c;
            margin-bottom: 10px;
        }
        .btn-eliminar {
            background-color: #d9534f;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../Logo/vitarisk.png" alt="Logo">
        </div>
        <ul class="sidebar-menu" id="sidebar-menu">
            <!-- Menú generado dinámicamente -->
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
                <h1>Mantenimientos</h1>
            </div>
            <div class="header-right">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Usuario Técnico</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Listado de Mantenimientos</h2>
            <!-- Botón para agregar nuevo mantenimiento -->
            <button class="btn btn-agregar" onclick="location.href='agregar_mantenimiento.php'">
                <i class="fas fa-plus"></i> Agregar
            </button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Hospital</th>
                            <th>Equipo</th>
                            <th>Fecha</th>
                            <th>Prioridad</th>
                            <th>Notas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mantenimientos as $mantenimiento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($mantenimiento['hospital']); ?></td>
                            <td><?php echo htmlspecialchars($mantenimiento['equipo']); ?></td>
                            <td><?php echo htmlspecialchars($mantenimiento['fecha']); ?></td>
                            <td>
                                <select class="priority" style="color: <?php echo getPriorityStyle($mantenimiento['prioridad']); ?>">
                                    <option value="high" <?php echo ($mantenimiento['prioridad'] == 'high') ? 'selected' : ''; ?>>Alta</option>
                                    <option value="medium" <?php echo ($mantenimiento['prioridad'] == 'medium') ? 'selected' : ''; ?>>Media</option>
                                    <option value="low" <?php echo ($mantenimiento['prioridad'] == 'low') ? 'selected' : ''; ?>>Baja</option>
                                </select>
                            </td>
                            <td><?php echo htmlspecialchars($mantenimiento['notas']); ?></td>
                            <td>
                                <!-- Botón para eliminar el mantenimiento (debe conectarse a la lógica de eliminación) -->
                                <form method="post" action="eliminar_mantenimiento.php" onsubmit="return confirm('¿Estás seguro de eliminar este mantenimiento?');">
                                    <!-- Se podría enviar un ID para identificar el registro -->
                                    <input type="hidden" name="equipo" value="<?php echo htmlspecialchars($mantenimiento['equipo']); ?>">
                                    <button type="submit" class="btn btn-eliminar">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
    <script>
        // Actualizar el color del texto en el selector de prioridad al cambiar el valor
        document.querySelectorAll(".priority").forEach(select => {
            select.addEventListener("change", function() {
                const colorMap = {
                    high: "#d9534f",
                    medium: "#f0ad4e",
                    low: "#5cb85c"
                };
                this.style.color = colorMap[this.value];
            });
        });
    </script>
</body>
</html>
