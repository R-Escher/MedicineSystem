<?php

if(isset($_COOKIE)){
  if ($_COOKIE['administrador'] == 'verdade') {
    echo "<script>window.location.href='admin.php';</script>";
  } elseif ($_COOKIE['medico'] == 'verdade') {
    echo "<script>window.location.href='medico.php';</script>";
  } elseif ($_COOKIE['laboratorio'] == 'verdade') {
    echo "<script>window.location.href='laboratorio.php';</script>";
  } elseif ($_COOKIE['paciente'] == 'verdade') {
    echo "<script>window.location.href='paciente.php';</script>";
  }
}
?>
