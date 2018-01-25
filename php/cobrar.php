<?php 
	include 'conexion.php';
	$id=$_POST['id'];
	if(isset($_POST['id'])){
		if($id==""){		
			header("Location: ../ordenes.php?error=Campos Vacios");
		}else{
			$getProd = $mysqli->query("select *, subtotal*cantidad as total from detalle_orden where idOrden=".$id)or die($mysqli->error);
			while($re=mysqli_fetch_array($getProd)){
				$mysqli->query("insert into ventas values(0,".$re['idOrden'].",".$re['idProducto'].",".$re['cantidad'].",".$re['subtotal'].",".$re['total'].",CURDATE())")or die($mysqli->error);
			}
			$mysqli->query("delete from referencia where idRef=".$id)or die($mysqli->error);
			$mysqli->query("delete from detalle_orden where idOrden=".$id)or die($mysqli->error);
			$mysqli->query("delete from orden where idOrden=".$id)or die($mysqli->error);
			header("Location: ../ordenes.php?id=0&clave=0&mesa=0");
		}	
	}
?>