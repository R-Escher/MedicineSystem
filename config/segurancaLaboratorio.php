<?php


if(isset($_SESSION['usuario'])){
  if ($_SESSION['laboratorio'] != true) {
    echo "<script>window.location.href='../index.php';</script>";
  }
}
?>
