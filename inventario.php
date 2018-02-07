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
				<?php
					include './php/conexion.php';
					$result=$mysqli->query("SELECT * FROM categorias")or die($mysqli->error);
					//a partir de acá comienza a imprimir en pantalla
					while ($categorias= mysqli_fetch_array($result)) {
						$cat1=$categorias['categoria'];
						//imprime el nombre de la categoria
						echo "<li><input type='checkbox' name='list' id='nivel1-".$categorias['idCategoria']."'><label for='nivel1-".$categorias['idCategoria']."'>".$categorias['categoria']."</label>";

						//obtiene los nombres de las subcategorias pertenecientes a esa categoria
						$result2 = $mysqli->query("SELECT * FROM productos WHERE categoria LIKE '%$cat1%'") or die($mysqli->error);
						//mientras haya registros los imprime
						while ($subcat = mysqli_fetch_array($result2)) {
							echo "<ul class='interior'>
											<li><a href='inventario.php?id=".$subcat['clave']."&clave=".$subcat['idProducto']."&mesa=".$_GET['mesa']." 'name='".$subcat['idProducto']."'>".$subcat['producto']."</a>
											</li>
										</ul>";
						}
						echo "</li>";
					}
				?>
			</ul>
		</div>
	</div>
	<nav id="header">
	  <ul>
	    <li><a href="./ordenes.php?id=0&clave=0&mesa=0">Órdenes</a></li>
	    <li style="background-color: gray; height: 30px; border-top-right-radius: 10px; border-top-left-radius: 10px; margin-left: -7px;"><a href="" style="font-weight: bold; color: black;">Inventario</a></li>
	    <li><a href="./ventas.php?id=0">Ventas</a></li>
	    <li><a href="./cortes.php">Corte</a></li>
	    <li><a href="">Usuarios</a></li>
	    <li><a href="">Sesión</a></li>
	  </ul>
	</nav>
	<div class="miniheader" style="background-color: gray; height: 180px; margin-top: -120px;">
		<?php
			$nombreProd = $mysqli->query("SELECT productos.*,ingredientes.ingredientes FROM productos, ingredientes where productos.idProducto=ingredientes.idProducto and productos.idProducto=".$_GET["clave"]) or die($mysqli->error);
			if($registro = mysqli_fetch_array($nombreProd)){
				echo "<label>".$registro['producto']."</label>";
				echo "<p><b>Precio</b><br>$".$registro['precio']."</p>
				";
				echo "<div id='ingre'>";
				echo "<ul><b>Ingredientes</b>";
				while ($fila = mysqli_fetch_array($nombreProd)) {
					echo "<li>".$fila['ingredientes']."</li>";
				}
				echo "</ul>";
				echo "</div>";
			}
		?>
	</div>
	<div id="container">
		<?php
			$getimg = $mysqli->query("select * from categorias, productos where productos.idProducto=".$_GET['clave']." and productos.categoria=categorias.categoria")or die($mysqli->error);
			if($r=mysqli_fetch_array($getimg)){
				echo "<img src='./img/".$r['imagen']."''>";
			}
		?>
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
		<form action="../php/insProdss.php" method="POST">
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
		<?php
			$datos=$mysqli->query("select * from productos where idProducto=".$_GET['clave'])or die($mysqli->error);
			while($mostrar=mysqli_fetch_array($datos)){
				echo "<div id='mostrarDatos'><label class='labels' style='margin-top: -260px; font-weight: bold; margin-left: 30px;'>Clave</label>
						<label class='labels' style='margin-top: -240px; font-size: 15px; margin-left: 40px;'>".$mostrar['clave']."</label>
						<label class='labels' style='margin-top: -205px; font-weight: bold; margin-left: 30px;'>Costo</label>
						<label class='labels' style='margin-top: -180px; font-size: 15px; margin-left: 40px;'>".$mostrar['costo']."</label>
						<label class='labels' style='margin-top: -145px; font-weight: bold; margin-left: 30px;'>Stock</label>
						<label class='labels' style='margin-top: -120px; font-size: 15px; margin-left: 40px;'>".$mostrar['stock']."</label>";
		?>
	</div>
	<?php
		echo "<label class='labels' style='margin-top: -260px; font-weight: bold; margin-left: 250px;'>Descripción</label>
		<p style='margin-left: 630px; margin-top: -230px;'>".$mostrar['descripcion'].".</p>";
	}
	?>

	<div id="btnagregar22">
	<i class="fa fa-plus"></i>
	</div>
	<div id="alerta22">
		<button id="cerrar22">
			<i class="fa fa-times"></i>
		</button>

		<h4>Agregar Ingredientes</h4>
		<form action="./php/insIng.php" method="POST" enctype="multipart/form-data">
			<fieldset style="display:none;">
				<label>Ingrediente</label><br>
				<input type="text" name="clave" value=<?php echo $_GET['clave']?>>
			</fieldset>
			<fieldset>
				<label>Ingrediente</label><br>
				<input type="text" name="ing">
			</fieldset>
			<fieldset>
				<button type="submit" class="btn">Agregar</button>
			</fieldset>
		</form>
	</div>

	<div id="btnagregar">
	<i class="fa fa-plus"></i>
	</div>
	<div id="alerta">
		<button id="cerrar">
			<i class="fa fa-times"></i>
		</button>

		<h4>Agregar Producto</h4>
		<form action="./php/insProd.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<label>Clave</label><br>
				<input type="text" name="clave" >
			</fieldset>
			<fieldset>
				<label>Nombre</label><br>
				<input type="text" name="nom" >
			</fieldset>
			<fieldset>
				<label>Costo</label><br>
				<input type="number" name="costo" >
			</fieldset>
			<fieldset>
				<label>Precio</label><br>
				<input type="number" name="precio" >
			</fieldset>
			<fieldset>
				<label>Stock</label><br>
				<input type="number" name="stock">
			</fieldset>
			<fieldset>
				<label>Descripcion</label><br>
				<input type="text" name="desc">
			</fieldset>
			<fieldset>
				<label>Categoria</label><br>
				<select name="cat" style="font-size:20px;padding: 5px 8px;width: 100%;height:30px;border: none;box-shadow: none;background: transparent;background-image: none;-webkit-appearance: none;">
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
			document.getElementById("btnagregar22").addEventListener('click',function(){
			var div=document.getElementById('alerta22');
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
		document.getElementById("cerrar22").addEventListener('click',function(){
			var div=document.getElementById('alerta22');
			div.className ="";
			si=false;
			div.style.display="none";
		});
		});
	</script>

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
