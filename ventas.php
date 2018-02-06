<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>La Condesa</title>
	<link rel="stylesheet" href="./css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="./css/listas.css">
	<?php
		if(isset($_GET['error'])){
			printf("<script type='text/javascript'>alert('Favor de llenar todos los campos'); </script>");
		}
	?>
</head>
<body>
	<div class="izq">
		<input type="search" id="txtBuscar" placeholder="Buscar">
		<div>
			<ul id="menu">
				<?php
					include './php/conexion.php';
					$result=$mysqli->query("SELECT distinct idOrden FROM ventas where fecha = CURRENT_DATE")or die($mysqli->error);
					while ($ventas= mysqli_fetch_array($result)) {
						echo "<li style='margin-left: 30%;font-weight: bold;'><a href='ventas.php?id=".$ventas['idOrden']."' name='".$ventas['idOrden']."'>Orden ".$ventas['idOrden']."</a>";
						echo "</li>";
					}
				?>
			</ul>
		</div>
	</div>
	<nav id="header">
	  <ul>
	    <li><a href="./ordenes.php?id=0&clave=0&mesa=0">Órdenes</a></li>
	    <li><a href="./inventario.php?id=0&clave=0&mesa=0">Inventario</a></li>
	    <li style="background-color: gray; height: 30px; border-top-right-radius: 10px; border-top-left-radius: 10px; margin-left: 5px;"><a href="" style="font-weight: bold; color: black;">Ventas</a></li>
	    <li><a href="./cortes.php">Corte</a></li>
	    <li><a href="">Usuarios</a></li>
	    <li><a href="">Sesión</a></li>
	  </ul>
	</nav>
	<div class="miniheader" style="background-color: gray; height: 180px; margin-top: -120px;">
    <p>ver detalle de órdenes cobradas en el día</p>
	</div>
	<div id="container">
    <button id="btnCobrar">CORTE</button>
		<div id="cobrar" style="top: 20px;">
			<button id="cerrarCobrar">
				<i class="fa fa-times"></i>
			</button>
			<h4>Hacer Corte</h4>
			<form action="./php/cobrar.php" method="POST">
				<fieldset>
					<button style="margin-top:20px; margin-left: 43%;background-color:green;" type="submit" class="btn">Corte</button>
				</fieldset>
			</form>
		</div>
		<button id="btnCancelar">CANCELAR</button>
		<div id="cancelar" style="top: 20px;">
			<button id="cerrarCancelar">
				<i class="fa fa-times"></i>
			</button>
			<h4>Desea cancelar la orden <?php
			$mesaCancelar=$mysqli->query("select * from ventas where idOrden=".$_GET['id'])or die($mysqli->error);
			if($mostrarMesa=mysqli_fetch_array($mesaCancelar)){
				echo $mostrarMesa['idOrden']."?";
			}
			?></h4>
			<form action="./php/borrarMesa.php" method="POST">
				<fieldset style="display: none;">
					<input type="text" name="borrar" value=<?php echo $_GET['mesa'];?>>
				</fieldset>
				<fieldset>
					<button style="margin-top:20px; margin-left: 43%;background-color:red;" type="submit" class="btn">Cancelar</button>
				</fieldset>
			</form>
		</div>
		<button id="btnEnviar">Imprimir</button>
		<hr>
		<?php
			$datos=$mysqli->query("select * from ventas where idOrden =".$_GET['id'])or die($mysqli->error);
			while($mostrar=mysqli_fetch_array($datos)){
				$total=$mysqli->query("select sum(subtotal) as total from detalle_orden where idOrden=".$_GET['id'])or die($mysqli->error());
				echo "<div id='mostrarDatos'><label class='labels' style='margin-top: -260px; font-weight: bold; margin-left: 30px;'>Orden</label>
						<label class='labels' style='margin-top: -240px; font-size: 15px; margin-left: 40px;'>".$mostrar['idOrden']."</label>";
					if($existe=mysqli_fetch_array($total)){
						echo "<label class='labels' style='margin-top: -10px; font-size: 15px; margin-left: 40px;'>".$existe['total']."</label>
						</div>";
					}
			}
		?>
		<div id="tabla">
			<table class="flat-table">
			  <tbody>
			    <tr>
			      <th>Código</th>
			      <th>Producto</th>
			      <th>Precio</th>
			      <th>Cantidad</th>
			      <th>Subtotal</th>
			    </tr>
			    <?php
			    	$detalle=$mysqli->query("select * from ventas, productos where ventas.claveProducto = productos.idProducto and ventas.idOrden=".$_GET['id'])or die($mysqli->error);
			    	while($productos=mysqli_fetch_array($detalle)){
			    		echo "<tr onclick='alert(this.getElementsByTagName('td')[0].innerHTML);alert(this.innerHTML);'>
							      <td>".$productos['clave']."</td>
							      <td>".$productos['producto']."</td>
							      <td>".$productos['precio']."</td>
							      <td>".$productos['cantidad']."</td>
							      <td>".$productos['subtotal']."</td>
							  </tr>";
			    	}

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
	<script type="text/javascript">
	var si=false;
	window.addEventListener('load',function (argument) {
	  document.getElementById("btnCancelar").addEventListener('click',function(){
	  var div=document.getElementById('cancelar');
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
	document.getElementById("cerrarCancelar").addEventListener('click',function(){
	  var div=document.getElementById('cancelar');
	  div.className ="";
	  si=false;
	  div.style.display="none";
	});
	});
</script>
<script type="text/javascript" src="./js/index.js"></script>
<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
</body>
</html>
