<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>La Condesa</title>
	<link rel="stylesheet" href="./css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="./css/listas.css">
  <link rel="stylesheet" href="./css/demo.css"/>
  <link rel="stylesheet" href="./css/styles.css"/>
	<?php
		if(isset($_GET['error'])){
			printf("<script type='text/javascript'>alert('Favor de llenar todos los campos'); </script>");
		}
	?>
</head>
<body>
	<div class="izq">
    <div class="field">
      <input name="date"/>
    </div>
	</div>
	<nav id="header">
	  <ul>
	    <li><a href="./ordenes.php?id=0&clave=0&mesa=0">Órdenes</a></li>
	    <li><a href="./inventario.php?id=0&clave=0&mesa=0">Inventario</a></li>
	    <li><a href="./ventas.php">Ventas</a></li>
	    <li style="background-color: gray; height: 30px; border-top-right-radius: 10px; border-top-left-radius: 10px; margin-left: 5px;"><a href="" style="font-weight: bold; color: black;">Corte</a></li>
	    <li><a href="">Usuarios</a></li>
	    <li><a href="">Sesión</a></li>
	  </ul>
	</nav>
	<div class="miniheader" style="background-color: gray; height: 180px; margin-top: -120px;">
	</div>
	<div id="container">
    <button id="btnCobrar">CORTE</button>
		<div id="cobrar" style="top: 20px;">
			<button id="cerrarCobrar">
				<i class="fa fa-times"></i>
			</button>
			<h4>HACER CORTE DE HOY</h4>
			<form action="./php/cobrar.php" method="POST">
				<fieldset>
					<button style="margin-top:20px; margin-left: 43%;background-color:green;" type="submit" class="btn">Corte</button>
				</fieldset>
			</form>
		</div>
		<button id="btnEnviar">Imprimir</button>
		<hr>
		<div id="tabla">
			<table class="flat-table" style="width: 100%;">
				<thead>
					Ventas por Categoría
				</thead>
			  <tbody>
			    <tr>
			      <th style="width: 50%;">Categoría</th>
			      <th style="width: 50%;">Monto</th>
			    </tr>
					<?php
						include './php/conexion.php';
						$r=$mysqli->query("select * from categorias")or die($mysqli->error);
						while($cats=mysqli_fetch_array($r)){
							echo "<tr>
								<td>".$cats['categoria']."</td>";
						}
						echo "</tr>";
					?>
			  </tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
    var si=false;
    window.addEventListener('load',function (argument) {
      document.getElementById("btnCobrar").addEventListener('click',function(){
      var div=document.getElementById('cobrar');
      if(si){
        div.className ="";
        si=false;
        div.style.display="none";
      }else{
        div.style.display="block";
        div.className +="iniciar";
        si=true;
      }
    });
    document.getElementById("cerrarCobrar").addEventListener('click',function(){
      var div=document.getElementById('cobrar');
      div.className ="";
      si=false;
      div.style.display="none";
    });
    });
 </script>
<script src="./js/datepicker.js"></script>
  <script>
      var input = document.querySelector('input[name="date"]');

      var picker = datepicker(input);
  </script>
<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
</body>
</html>
