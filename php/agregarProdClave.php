<?php 
	include 'conexion.php';
	$id=$POST['id'];
	$prod=$_POST['clave'];
	$mesa=$_POST['mesa'];
	if(isset($_POST['clave'])&&isset($_POST['mesa'])){
		if($mesa=="" && $prod==""){		
			header("Location: ../ordenes.php?error=Campos Vacios");
		}else{
			$getProd = $mysqli->query("select * from productos, detalle_orden where productos.clave=".$prod." and detalle_orden.idProducto=".$prod." and detalle_orden.idOrden=".$mesa)or die($mysqli->error);
			if(mysqli_num_rows($getProd)==0){
				$getProd2 = $mysqli->query("select * from productos where clave=".$prod)or die($mysqli->error);
				if($registro=mysqli_fetch_array($getProd2)){
					$mysqli->query("insert into detalle_orden values(0,".$mesa.",".$prod.",1,".$registro['precio'].",".$registro['precio'].")")or die($mysqli->error);
					header("Location: ../ordenes.php?clave=".$prod."&mesa=".$mesa);
				}
			}else{
				$mysqli->query("update detalle_orden set cantidad=cantidad+1, subtotal=cantidad*precioUnitario where idOrden=".$mesa." and clave=".$prod)or die($mysqli->error);
				header("Location: ../ordenes.php?clave=".$prod."&mesa=".$mesa);
			}
		}
	}
?>