<?php
session_start();
session_destroy();
setcookie('administrador', 'verdade', time() - 360,'/');
setcookie('medico', 'verdade', time() - 360,'/');
setcookie('laboratorio', 'verdade', time() - 360,'/');
setcookie('paciente', 'verdade', time() - 360,'/');

echo "<script>window.location.href='../index.php';</script>";
?>
