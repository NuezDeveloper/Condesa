<?php
  $fecha=$_POST['date'];
  if(isset($_POST['date'])){
    if($fecha == ""){
      header("Location: ../cortes.php?errorfecha=123&fecha=CURDATE()");
    }else{
      header("Location: ../cortes.php?fecha=".$fecha);
    }
  }
?>
