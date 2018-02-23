<html>
<head lang="es">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./css/login.css">
  <title>LogIn</title>
</head>
<body>
  <div id="login">
  </div>
  <div class="formulario container">
    <h1>Inicio de Sesión</h1>
    <form action="./php/verificarindex.php">
      <div class="group">
        <fieldset>
          <input type="text" >
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Usuario</label>
        </fieldset>
      </div>
      <div class="group">
        <fieldset>
          <input type="password" name="" value="" >
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Contraseña</label>
        </fieldset>
      </div>
      <input type="submit" value="INGRESAR">
    </form>
  </div>
</body>
</html>
