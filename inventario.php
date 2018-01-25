<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inventario</title>
	<link rel="stylesheet" href="./css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="./css/listas.css">
</head>
<body>
	<div class="izq">
		<input type="search" placeholder="Buscar">
		<div>
			<ul id="menu">
	   			<li><input type="checkbox" name="list" id="nivel1-1"><label for="nivel1-1">Pizzas</label>
	   				<ul class="interior">
	         			<li><a>Nivel 2</a>
	         			</li>
	         			<li><a>Nivel 2</a>
	         			</li>
	      			</ul>
	   			</li>
	   			<li><input type="checkbox" name="list" id="nivel1-2"><label for="nivel1-2">Pastas</label>
	      			<ul class="interior">
	        			<li><a>Nivel 2</a>
	         			</li>
	         			<li><a>Nivel 2</a>
	         			</li>
	      			</ul>
	   			</li>
	   			<li><input type="checkbox" name="list" id="nivel1-3"><label for="nivel1-3">Ensaladas</label>
	   				<ul class="interior">
	         			<li><a>Nivel 2</a>
	         			</li>
	         			<li><a>Nivel 2</a>
	         			</li>
	      			</ul>
	   			</li>
	   			<li><input type="checkbox" name="list" id="nivel1-4"><label for="nivel1-4">Bebidas</label>
	      			<ul class="interior">
	        			<li><a>Nivel 2</a>
	         			</li>
	         			<li><a>Nivel 2</a>
	         			</li>
	      			</ul>
	   			</li>
	   			<li><input type="checkbox" name="list" id="nivel1-5"><label for="nivel1-5">Postres</label>
	   				<ul class="interior">
	         			<li><a>Nivel 2</a>
	         			</li>
	         			<li><a>Nivel 2</a>
	         			</li>
	      			</ul>
	   			</li>
	   			<li><input type="checkbox" name="list" id="nivel1-6"><label for="nivel1-6">Entradas</label>
	      			<ul class="interior">
	        			<li><a>Nivel 2</a>
	         			</li>
	         			<li><a>Nivel 2</a>
	         			</li>
	      			</ul>
	   			</li>
			</ul>
		</div>
	</div>
	<nav id="header">
	  <ul>
	    <li><a href="./ordenes.php?id=0&clave=0&mesa=0">Órdenes</a></li>
	    <li style="background-color: gray; height: 30px; border-top-right-radius: 10px; border-top-left-radius: 10px; margin-left: -7px;"><a href="" style="font-weight: bold; color: black;">Inventario</a></li>
	    <li><a href="">Ventas</a></li>
	    <li><a href="">Corte</a></li>
	    <li><a href="">Usuarios</a></li>
	    <li><a href="">Sesión</a></li>
	  </ul>
	</nav>
	<div class="miniheader" style="background-color: gray; height: 180px; margin-top: -120px;">
		<label>La Condesa</label>
		<ul><b>Ingredientes</b>
			<li>Tomate deshidratado</li>
			<li>Cebolla caramelizada</li>
			<li>Aceituna negra</li>
			<li>Pepperoni</li>
			<li>Tomate deshidratado</li>
			<li>Cebolla caramelizada</li>
			<li>Aceituna negra</li>
			<li>Pepperoni</li>
			<li>Tomate deshidratado</li>
			<li>Cebolla caramelizada</li>
			<li>Aceituna negra</li>
			<li>Pepperoni</li>
			<li>Tomate deshidratado</li>
			<li>Cebolla caramelizada</li>
			<li>Aceituna negra</li>
			<li>Pepperoni</li>
		</ul>
		<p> <b>Precio</b><br>$140.00</p>
		<button id="btnEliminar"></button>
	</div>
	<div id="container">
		<img src="http://cdn2.cocinadelirante.com/sites/default/files/images/2017/01/pizzapepperonni.jpg">
		<div style="height: 70px;"></div>
		<hr>
		<button id="refresh"></button>
		<div id="modificar">
			<button id="cerrarMod">
				<i class="fa fa-times"></i>
			</button>

			<h4>Modificar</h4>
			<button id="modificarProducto">Producto</button>
			<div id="panelModProd">
		<button id="cerrarModProd">
			<i class="fa fa-times"></i>
		</button>

		<h4>Modificar Producto</h4>
		<form action="../php/insacor.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<label>Clave</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Nombre</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Costo</label><br>
				<input type="number" name="nom" >
			</fieldset>
			<fieldset>
				<label>Precio</label><br>
				<input type="number" name="nom" >
			</fieldset>
			<fieldset>
				<label>Descripcion</label><br>
				<input type="text" name="desc">
			</fieldset>
			<fieldset>
				<label>Categoria</label><br>
				<select name="cat">
					
				</select>
			</fieldset>
			<fieldset>
				<label>Ingredientes</label><br>
				<input type="text" name="ingredientes">
			</fieldset>
			<fieldset>
				<button type="submit" class="btn">Modificar</button>
			</fieldset>
		</form>

	</div>
			<button id="modificarCategoria">Categoría</button>
			<div id="panelModCat">
		<button id="cerrarModCat">
			<i class="fa fa-times"></i>
		</button>
		<h4>Modificar Categoría</h4>
		<form action="../php/insacor.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<label>Nombre</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Imagen</label><br>
				<input type="file" name="imagen">
			</fieldset>
			<fieldset>
				<button type="submit" class="btn">Modificar</button>
			</fieldset>
		</form>
	</div>
		</div>
		<label class="labels" style="margin-top: -260px; font-weight: bold; margin-left: 30px;">Clave</label>
		<label class="labels" style="margin-top: -240px; font-size: 15px; margin-left: 40px;">1</label>
		<label class="labels" style="margin-top: -205px; font-weight: bold; margin-left: 30px;">Costo</label>
		<label class="labels" style="margin-top: -180px; font-size: 15px; margin-left: 40px;">1</label>
		<label class="labels" style="margin-top: -145px; font-weight: bold; margin-left: 30px;">Stock</label>
		<label class="labels" style="margin-top: -120px; font-size: 15px; margin-left: 40px;">1</label>
		<label class="labels" style="margin-top: -260px; font-weight: bold; margin-left: 250px;">Descripción</label>
		<p style="margin-left: 630px;
    margin-top: -230px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>

	<div id="btnagregar">
	<i class="fa fa-plus"></i>
	</div>
	<div id="alerta">
		<button id="cerrar">
			<i class="fa fa-times"></i>
		</button>

		<h4>Agregar Producto</h4>
		<form action="../php/insacor.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<label>Clave</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Nombre</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Costo</label><br>
				<input type="number" name="nom" >
			</fieldset>
			<fieldset>
				<label>Precio</label><br>
				<input type="number" name="nom" >
			</fieldset>
			<fieldset>
				<label>Descripcion</label><br>
				<input type="text" name="desc">
			</fieldset>
			<fieldset>
				<label>Categoria</label><br>
				<select name="cat">
					<?php 
						include './php/conexion.php';
						$re=$mysqli->query("select * from categorias;")or die($mysqli->error);
						while($fila=mysqli_fetch_array($re)){
							echo "<option value='".$fila['categoria']."'>".$fila['categoria']."</option>";
						}
					?>
				</select>
			</fieldset>
			<fieldset>
				<label>Ingredientes</label><br>
				<input type="text" name="ingredientes">
			</fieldset>
			<fieldset>
				<button type="submit" class="btn">Insertar</button>
			</fieldset>
		</form>
	</div>


<div id="btnagregarCat">
	<i class="fa fa-plus"></i>
	</div>
	<div id="alertaCat">
		<button id="cerrarCat">
			<i class="fa fa-times"></i>
		</button>
		<h4>Agregar Categoría</h4>
		<form action="../php/insacor.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<label>Nombre</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Imagen</label><br>
				<input type="file" name="imagen">
			</fieldset>
			<fieldset>
				<button type="submit" class="btn">Insertar</button>
			</fieldset>
		</form>
	</div>
	<script type="text/javascript">
		var si=false;
		window.addEventListener('load',function (argument) {
			document.getElementById("btnagregar").addEventListener('click',function(){
			var div=document.getElementById('alerta');
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
		document.getElementById("cerrar").addEventListener('click',function(){
			var div=document.getElementById('alerta');
			div.className ="";
			si=false;
			div.style.display="none";
		});
		});
	</script>
	<script type="text/javascript">
		var si=false;
		window.addEventListener('load',function (argument) {
		document.getElementById("btnagregarCat").addEventListener('click',function(){
			var div=document.getElementById('alertaCat');
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
		document.getElementById("cerrarCat").addEventListener('click',function(){
			var div=document.getElementById('alertaCat');
			div.className ="";
			si=false;
			div.style.display="none";
		});
		});
	</script>
	<script type="text/javascript">
		var si=false;
		window.addEventListener('load',function (argument) {
		document.getElementById("refresh").addEventListener('click',function(){
			var div=document.getElementById('modificar');
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
		document.getElementById("cerrarMod").addEventListener('click',function(){
			var div=document.getElementById('modificar');
			div.className ="";
			si=false;
			div.style.display="none";
		});
		});
	</script>
	<script type="text/javascript">
		var si=false;
		window.addEventListener('load',function (argument) {
		document.getElementById("modificarProducto").addEventListener('click',function(){
			var div=document.getElementById('panelModProd');
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
		document.getElementById("cerrarModProd").addEventListener('click',function(){
			var div=document.getElementById('panelModProd');
			div.className ="";
			si=false;
			div.style.display="none";
		});
		});
	</script>
	<script type="text/javascript">
		var si=false;
		window.addEventListener('load',function (argument) {
		document.getElementById("modificarCategoria").addEventListener('click',function(){
			var div=document.getElementById('panelModCat');
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
		document.getElementById("cerrarModCat").addEventListener('click',function(){
			var div=document.getElementById('panelModCat');
			div.className ="";
			si=false;
			div.style.display="none";
		});
		});
	</script>
</body>
</html>
