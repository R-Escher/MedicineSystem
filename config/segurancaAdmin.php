<?php
ini_set('display_errors', 1);
var_dump($_SESSION['usuario']);
if(isset($_SESSION['usuario'])){
  if ($_SESSION['administrador'] != true) {
    echo "<script>window.location.href='../index.php';</script>";
  }
}
?>
