<?php
include 'conexion.php';
$ing=$_POST['ing'];
$clave=$_POST['clave'];
if(isset($_POST['ing']) && isset($_POST['clave'])){
	if($ing=="" || $clave==""){
		header("Location: ../inventario.php?id=0&clave=0&mesa=0&error=error");
	}else{
		$mysqli->query("insert into ingredientes values($clave,'$ing')")or die("ERROR: " .$mysqli->error);
		header("Location: ../inventario.php?id=0&clave=$clave&mesa=0");
	}
	}else{
		//header("Location: ../registro.php?error=Campos Vacios" );
	}
 ?>
