<?php
include 'conexion.php';
$clave=$_POST['clave'];
$nom=$_POST['nom'];
$costo=$_POST['costo'];
$precio=$_POST['precio'];
$stock=$_POST['stock'];
$desc=$_POST['desc'];
$cat=$_POST['cat'];
if(isset($_POST['clave']) && isset($_POST['nom']) && isset($_POST['costo']) && isset($_POST['precio']) && isset($_POST['desc']) && isset($_POST['cat'])){
	if($clave=="" || $nom=="" || $costo=="" || $precio=="" || $desc=="" || $cat==""){
		header("Location: ../inventario.php?id=0&clave=0&mesa=0&error=error");
	}else{
		$verificar=$mysqli->query("select * from productos where clave='".$clave."'")or die($mysqli->error);
		if(mysqli_num_rows($verificar)!=0){
			header("Location: ../inventario.php?id=0&clave=0&mesa=0&errorproducto");
		}else{
			$mysqli->query("insert into productos values(0,'$clave','$nom','$costo',$precio,$stock,'$desc','$cat')")or die("ERROR: " .$mysqli->error);
			header("Location: ../inventario.php?id=".$clave."&mesa=0&clave=".$mysqli->insert_id);
		}
	}
	}else{
		//header("Location: ../registro.php?error=Campos Vacios" );
	}
 ?>
