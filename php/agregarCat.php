<?php
	include 'conexion.php';
	$cat=$_POST['categoria'];
	$img=$_POST['img'];
	if(isset($_POST['categoria'])&&isset($_POST['img'])){
		if($cat=="" && $img==""){
			header("Location: ../ordenes.php?errormesa=Campos Vacios");
		}else{
			
		}
	}
?>
