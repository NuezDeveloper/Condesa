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
		if(isset($_GET['errormesa'])){
			printf("<script type='text/javascript'>alert('No seleccionaste ninguna mesa para cobrar/eliminar'); </script>");
		}
		if(isset($_GET['errorprod'])){
			printf("<script type='text/javascript'>alert('No seleccionaste ninguna mesa o producto para agregar/eliminar'); </script>");
		}
		if(isset($_GET['errormesamod'])){
			printf("<script type='text/javascript'>alert('No seleccionaste ninguna mesa o producto para modificar'); </script>");
		}
		if(isset($_GET['errorp'])){
			printf("<script type='text/javascript'>alert('El producto no existe'); </script>");
		}
	?>
</head>
<body>
	<div class="izq">
		<form class="" action="./php/agregarProdClave.php" method="POST">
			<fieldset style="margin-left:-20px;margin-top:-14px;">
				<input type="search" name="clave" placeholder="Buscar">
			</fieldset>
			<fieldset style="display:none;">
				<input type="text" name="mesa" value=<?php echo $_GET['mesa']?>>
			</fieldset>
			<fieldset style="display:none;">
				<input type="submit" value="">
			</fieldset>
		</form>
		<div style="margin-top:15px;">
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
											<li><a href='ordenes.php?id=".$subcat['clave']."&clave=".$subcat['idProducto']."&mesa=".$_GET['mesa']." 'name='".$subcat['idProducto']."'>".$subcat['producto']."</a>
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
	    <li style="background-color: gray; height: 30px; border-top-right-radius: 10px; border-top-left-radius: 10px; margin-left: 5px;"><a href="" style="font-weight: bold; color: black;">Órdenes</a></li>
	    <li><a href="./inventario.php?id=0&clave=0&mesa=0">Inventario</a></li>
	    <li><a href="./ventas.php?id=0">Ventas</a></li>
	    <li><a href="./cortes.php?fecha=CURDATE()">Corte</a></li>
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
		<form action="./php/agregarProd.php" method="POST">
			<fieldset style="display: none;">
				<input type="text" name="producto" value=<?php echo $_GET['clave']?>>
			</fieldset>
			<fieldset style="display: none;">
				<input type="text" name="mesa" value=<?php echo $_GET['mesa']?>>
			</fieldset>
			<fieldset>
				<input type="submit" value="" id="btnplus">
			</fieldset>
		</form>
		<form action="./php/borrarProd.php" method="POST">
			<fieldset style="display: none;">
				<input type="text" name="producto2" value=<?php echo $_GET['clave']?>>
			</fieldset>
			<fieldset style="display: none;">
				<input type="text" name="mesa2" value=<?php echo $_GET['mesa']?>>
			</fieldset>
			<fieldset>
				<input type="submit" value="" id="btnless">
			</fieldset>
		</form>
	</div>
	<div id="container">
		<?php
			$getimg = $mysqli->query("select * from categorias, productos where productos.idProducto=".$_GET['clave']." and productos.categoria=categorias.categoria")or die($mysqli->error);
			if($r=mysqli_fetch_array($getimg)){
				echo "<img src='./img/".$r['imagen']."''>";
			}
		?>
		<div id="mesas">
			<?php
				$mesas = $mysqli->query("select * from referencia where estatus != 'completa'");
				while($filaMesas = mysqli_fetch_array($mesas)){
					$valor=$filaMesas['mesa'];
					if($valor=='llevar'){
						echo "<a href='./ordenes.php?id=".$_GET['id']."&clave=".$_GET['clave']."&mesa=".$filaMesas['idRef']."'>".$filaMesas['referencia']."</a>";
					}else{
						echo "<a href='./ordenes.php?id=".$_GET['id']."&clave=".$_GET['clave']."&mesa=".$filaMesas['idRef']."'>Mesa ".$filaMesas['mesa']."</a>";
					}
				}
			?>
			<button id="btnagregarorden"></button>
		</div>
		<div id="alerta" style="top: 20px;">
			<button id="cerrar">
				<i class="fa fa-times"></i>
			</button>
			<h4>Agregar Orden</h4>
			<form action="./php/insref.php" method="POST">
				<fieldset>
					<label>Mesa</label><br>
					<select name="mesa"style="font-size:20px;padding: 5px 8px;width: 100%;height:30px;border: none;box-shadow: none;background: transparent;background-image: none;-webkit-appearance: none;">
						<option value="llevar">LLEVAR</option>
						<option value="1">Mesa 1</option>
						<option value="2">Mesa 2</option>
						<option value="3">Mesa 3</option>
						<option value="4">Mesa 4</option>
						<option value="5">Mesa 5</option>
						<option value="6">Mesa 6</option>
						<option value="7">Mesa 7</option>
						<option value="8">Mesa 8</option>
						<option value="9">Mesa 9</option>
						<option value="10">Mesa 10</option>
						<option value="11">Mesa 11</option>
						<option value="12">Mesa 12</option>
						<option value="13">Mesa 13</option>
						<option value="14">Mesa 14</option>
						<option value="15">Mesa 15</option>
						<option value="16">Mesa 16</option>
						<option value="17">Mesa 17</option>
						<option value="18">Mesa 18</option>
						<option value="19">Mesa 19</option>
						<option value="20">Mesa 20</option>
					</select>
				</fieldset>
				<fieldset>
					<label>Mesero</label><br>
					<select name="mesero" style="font-size:20px;padding: 5px 8px;width: 100%;height:30px;border: none;box-shadow: none;background: transparent;background-image: none;-webkit-appearance: none;">
						<?php
							$re=$mysqli->query("select nombre from empleados;")or die($mysqli->error);
							while($fila=mysqli_fetch_array($re)){
								echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
							}
						?>
					</select>
				</fieldset>
				<fieldset>
					<label>Referencia</label><br>
					<input type="text" name="referencia" >
				</fieldset>
				<fieldset>
					<button style="margin-top:20px; margin-left: 40%;" type="submit" class="btn">Agregar</button>
				</fieldset>
			</form>
		</div>
		<button id="btnCobrar">COBRAR</button>
		<div id="cobrar" style="top: 20px;">
			<button id="cerrarCobrar">
				<i class="fa fa-times"></i>
			</button>
			<h4>Cobrar Orden</h4>
			<form action="./php/cobrar.php" method="POST">
				<div id="tabla" style="margin-left:0px;margin-top:20px;width:100%;">
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
					    	$detalleTotal=$mysqli->query("select productos.*,detalle_orden.* from productos,detalle_orden where productos.idProducto=detalle_orden.idProducto and detalle_orden.idOrden=".$_GET['mesa'])or die($mysqli->error);
					    	while($productos=mysqli_fetch_array($detalleTotal)){
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
				<fieldset style="width:30%; margin-top: -10px; float: left;">Pago:
					<input id="txtPay" onkeyup="asd()" onkeypress="exec()" type="number" name="txtPagar" value="" style="border: 1px solid red; text-align: center;">
				</fieldset>
				<fieldset style="margin-left:40%;float: left;margin-top:-10px;">Cambio:
					<label id="lblcambio">0</label>
				</fieldset>
				<br>
				<fieldset style="display: none;">
					<input type="text" name="id" value=<?php echo $_GET['mesa'];?>>
				</fieldset>
				<br>
				<br>
				<fieldset>
					<button style="margin-top: 15px; align:center; background-color:green;" type="submit" class="btn" id="realizarPago">Cobrar</button>
				</fieldset>
			</form>
		</div>
		<button id="btnCancelar">CANCELAR</button>
		<div id="cancelar" style="top: 20px;">
			<button id="cerrarCancelar">
				<i class="fa fa-times"></i>
			</button>
			<h4>Desea cancelar la orden de la mesa <?php
			$mesaCancelar=$mysqli->query("select * from referencia where idRef=".$_GET['mesa'])or die($mysqli->error);
			if($mostrarMesa=mysqli_fetch_array($mesaCancelar)){
				echo $mostrarMesa['mesa']."?";
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
		<button id="btnEnviar">ENVIAR</button>
		<hr id="hr">
		<button id="refresh"></button>
		<div id="modificarMesa" style="top: 20px;">
			<button id="cerrarModificarMesa">
				<i class="fa fa-times"></i>
			</button>
			<h4>Modificar mesa <?php
			$mesaCancelar=$mysqli->query("select * from referencia where idRef=".$_GET['mesa'])or die($mysqli->error);
			if($mostrarMesa=mysqli_fetch_array($mesaCancelar)){
				echo $mostrarMesa['mesa'];
			}
			?></h4>
			<form action="./php/modificarMesa.php" method="POST">
				<fieldset style="display: none;">
					<input type="text" name="orden" value=<?php echo $_GET['mesa'];?>>
				</fieldset>
				<fieldset>
					<label>Mesa</label><br>
					<select name="mesa"style="font-size:20px;padding: 5px 8px;width: 100%;height:30px;border: none;box-shadow: none;background: transparent;background-image: none;-webkit-appearance: none;">
						<option value="1">Mesa 1</option>
						<option value="2">Mesa 2</option>
						<option value="3">Mesa 3</option>
						<option value="4">Mesa 4</option>
						<option value="5">Mesa 5</option>
						<option value="6">Mesa 6</option>
						<option value="7">Mesa 7</option>
						<option value="8">Mesa 8</option>
						<option value="9">Mesa 9</option>
						<option value="10">Mesa 10</option>
						<option value="11">Mesa 11</option>
						<option value="12">Mesa 12</option>
						<option value="13">Mesa 13</option>
						<option value="14">Mesa 14</option>
						<option value="15">Mesa 15</option>
						<option value="16">Mesa 16</option>
						<option value="17">Mesa 17</option>
						<option value="18">Mesa 18</option>
						<option value="19">Mesa 19</option>
						<option value="20">Mesa 20</option>
					</select>
				</fieldset>
				<fieldset>
					<label>Mesero</label><br>
					<select name="mesero" style="font-size:20px;padding: 5px 8px;width: 100%;height:30px;border: none;box-shadow: none;background: transparent;background-image: none;-webkit-appearance: none;">
						<?php
							$re=$mysqli->query("select nombre from empleados;")or die($mysqli->error);
							while($fila=mysqli_fetch_array($re)){
								echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
							}
						?>
					</select>
				</fieldset>
				<fieldset>
					<label>Referencia</label><br>
					<input type="text" name="referencia" >
				</fieldset>
				<fieldset>
					<button style="margin-top:20px; margin-left: 43%;background-color:green;" type="submit" class="btn">Aceptar</button>
				</fieldset>
			</form>
		</div>

		<?php
			$datos=$mysqli->query("select * from orden, referencia where orden.idOrden = referencia.idRef and referencia.idRef=".$_GET['mesa'])or die($mysqli->error);
			while($mostrar=mysqli_fetch_array($datos)){
				$total=$mysqli->query("select sum(subtotal) as total from detalle_orden where idOrden=".$_GET['mesa'])or die($mysqli->error());
				echo "<div id='mostrarDatos'><label class='labels' style='margin-top: -260px; font-weight: bold; margin-left: 30px;'>Orden</label>
						<label class='labels' style='margin-top: -240px; font-size: 15px; margin-left: 40px;'>".$mostrar['idOrden']."</label>
						<label class='labels' style='margin-top: -205px; font-weight: bold; margin-left: 30px;'>Mesa</label>
						<label class='labels' style='margin-top: -180px; font-size: 15px; margin-left: 40px;'>".$mostrar['mesa']."</label>
						<label class='labels' style='margin-top: -150px; font-weight: bold; margin-left: 30px;'>Mesero</label>
						<label class='labels' style='margin-top: -125px; font-size: 15px; margin-left: 40px;'>".$mostrar['mesero']."</label>
						<label class='labels' style='margin-top: -95px; font-weight: bold; margin-left: 30px;'>Referencia</label>
						<label class='labels' style='margin-top: -70px; font-size: 15px; margin-left: 40px;'>".$mostrar['referencia']."</label>
						<label class='labels' style='margin-top: 5px; font-weight: bold; margin-left: 30px;'>Total</label>";
					if($existe=mysqli_fetch_array($total)){
						echo "<label id='lbltotal' class='labels' style='margin-top: 5px; font-size: 15px; margin-left: 95px;'>".$existe['total']."</label>
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
						<th>Cambiar</th>
			    </tr>
			    <?php
			    	$detalle=$mysqli->query("select productos.*,detalle_orden.* from productos,detalle_orden where productos.idProducto=detalle_orden.idProducto and detalle_orden.idOrden=".$_GET['mesa'])or die($mysqli->error);
			    	while($productos=mysqli_fetch_array($detalle)){
			    		echo "<tr onclick='alert(this.getElementsByTagName('td')[0].innerHTML);alert(this.innerHTML);'>
							      <td>".$productos['clave']."</td>
							      <td>".$productos['producto']."</td>
							      <td>".$productos['precio']."</td>
							      <td>".$productos['cantidad']."</td>
							      <td>".$productos['subtotal']."</td>
										<td style='padding:0px;'><form action='./php/agregarProd.php' method='POST'>
											<fieldset style='display: none;'>
												<input type='text' name='producto' value=".$productos['idProducto'].">
											</fieldset>
											<fieldset style='display: none;'>
												<input type='text' name='mesa' value=".$_GET['mesa'].">
											</fieldset>
											<fieldset>
												<input type='submit' value='' style='height: 20px;
											  width: 20px;
											  margin-left: 20px;
											  margin-top: 0px;
											  background-image: url(./img/plus.png);
											  background-size: cover;
											  background-color: transparent;
											  border: none;'>
											</fieldset>
										</form>
										<form action='./php/borrarProd.php' method='POST'>
											<fieldset style='display: none;'>
												<input type='text' name='producto2' value=".$productos['idProducto'].">
											</fieldset>
											<fieldset style='display: none;'>
												<input type='text' name='mesa2' value=".$_GET['mesa'].">
											</fieldset>
											<fieldset style='margin-top: -44px;'>
												<input type='submit' value='' style='height: 20px;
											  width: 20px;
											  margin-left: 50px;
											  margin-top: -20px;
											  background-image: url(./img/less.png);
											  background-size: cover;
											  background-color: transparent;
											  border: none;'>
											</fieldset>
										</form></td>
							  </tr>";
			    	}

			    ?>
			  </tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		function asd(e){
			var txt = document.getElementById('txtPay').value;
			var tot = parseInt(document.getElementById('lbltotal').innerHTML);
			var t = parseInt(txt);
			if(t-tot<0){
				document.getElementById('lblcambio').innerText="INCOMPLETO";
				document.getElementById('realizarPago').style.display='none';
			}else{
				document.getElementById('lblcambio').innerText="$"+(t-tot);
			}
			if(t>=tot){
				document.getElementById('txtPay').style.border="1px solid green";
				document.getElementById('realizarPago').style.display='block';
				document.getElementById('realizarPago').type="submit";
			}else{
				document.getElementById('txtPay').style.border="1px solid red";
				document.getElementById('realizarPago').type="button";
			}
			if(txt==""){
				document.getElementById('lblcambio').innerText="";
			}
		}
	</script>
	<script type="text/javascript">
		var si=false;
		window.addEventListener('load',function (argument) {
			document.getElementById("btnagregarorden").addEventListener('click',function(){
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
				document.getElementById("txtPay").focus();
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
 </script>
	<script type="text/javascript">
	var si=false;
	window.addEventListener('load',function (argument) {
	  document.getElementById("refresh").addEventListener('click',function(){
	  var div=document.getElementById('modificarMesa');
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
	document.getElementById("cerrarModificarMesa").addEventListener('click',function(){
	  var div=document.getElementById('modificarMesa');
	  div.className ="";
	  si=false;
	  div.style.display="none";
	});
	});
</script>
<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
</body>
</html>
