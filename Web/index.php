<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="css/index.css">
  <title>Login - VitalRisk</title>
</head>
<body>
  <div class="container" id="container">
    
    <!-- Formulario de Login -->
    <div class="form-container sign-in">
      <form action="login.php" method="POST">
        <h1>Iniciar Sesión</h1>
        <span>Ingresa tus credenciales</span>
        <input type="text" name="idUsuario" placeholder="ID de Usuario" required>
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <button type="submit">Ingresar</button>
        <?php if(isset($_GET['error'])): ?>
          <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
      </form>
    </div>

    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>¡Bienvenido a VitalRisk!</h1>
          <p>Ingresa tu ID de usuario y nombre de usuario para acceder</p>
        </div>
      </div>
    </div>
    
  </div>
</body>
</html>