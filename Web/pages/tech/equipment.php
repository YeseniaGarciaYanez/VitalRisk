<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/table.css">
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
                <h1>Equipment</h1>
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
        <div class="content">
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipo</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Piezas</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $file = file_get_contents('https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos?ubicacion=Hospital%20General%20de%20Tijuana,%20Baja%20California');
                $data = json_decode($file, true);

                foreach($data as $item){
                    ?>
                    <td><?php $ID = $item['ID Equipo']; echo $ID; ?></td>
                    <td><?php $equipo = $item['Nombre del Equipo']; echo $equipo; ?></td>
                    <td><?php $categoria = $item['Categoría']; echo $categoria; ?></td>
                    <td><?php $marca = $item['Marca']; echo $marca; ?></td>
                    <td><?php $modelo = $item['Modelo']; echo $modelo; ?></td>
                    <td><?php $piezas = $item['Piezas']; echo $piezas; ?></td>
                    <td><?php $estado = $item['Estado']; echo $estado; ?></td>
                    </tr>
              <?php  } 

            ?>
        
            
            
        </tbody>
    </table>
</div>

        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
