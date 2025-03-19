<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <!-- Fuente de Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- Tu CSS -->
  <link rel="stylesheet" href="css/index.css">
  <title>Modern Login Page | AsarProg</title>
</head>
<body>
  <div class="container" id="container">
    
    <!-- Formulario de Sign In (Login) - Visible por defecto -->
    <div class="form-container sign-in">
      <form>
        <h1>Sign In</h1>
        <span>or use your email password</span>
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Password">
        <a href="#">Forget Your Password?</a>
        <button>Sign In</button>
      </form>
    </div>

    <!-- Formulario de Sign Up (Create Account) - Oculto por defecto -->
    <div class="form-container sign-up">
      <form>
        <h1>Create Account</h1>
        <span>or use your email for registration</span>
        <input type="text" placeholder="Name">
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Password">
        <button>Sign Up</button>
      </form>
    </div>

    <!-- Contenedor para el toggle (panel con botones para cambiar entre formularios) -->
    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>Welcome Back</h1>
          <p>Enter your personal details to use all of site features</p>
          <button class="hidden" id="login">Sign In</button>
        </div>
        <div class="toggle-panel toggle-right">
          <h1>Hello, Friend</h1>
          <p>Register with your personal details to use all of site features</p>
          <button class="hidden" id="register">Sign Up</button>
        </div>
      </div>
    </div>
    
  </div>
  
  <script src="script.js"></script>
</body>
</html>
