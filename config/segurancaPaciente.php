<?php


if(isset($_SESSION['usuario'])){
  if ($_SESSION['paciente'] != true) {
    echo "<script>window.location.href='../index.php';</script>";
  }
}
?>
