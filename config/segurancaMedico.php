<?php


if(isset($_SESSION['usuario'])){
  if ($_SESSION['medico'] != true) {
    echo "<script>window.location.href='../index.php';</script>";
  }
}
?>
