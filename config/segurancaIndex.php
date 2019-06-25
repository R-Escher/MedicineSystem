<?php
ini_set('display_errors', 1);


var_dump($_SESSION);
if(isset($_SESSION['usuario'])){
  if ($_SESSION['administrador'] == true) {
    echo "<script>window.location.href='../admin.php';</script>";
  } elseif ($_SESSION['medico'] == true) {
    echo "<script>window.location.href='../medico.php';</script>";
  } elseif ($_SESSION['laboratorio'] == true) {
    echo "<script>window.location.href='../laboratorio.php';</script>";
  } elseif ($_SESSION['paciente'] == true) {
    echo "<script>window.location.href='../paciente.php';</script>";
  }
}
?>
