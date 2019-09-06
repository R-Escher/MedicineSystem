<?php
session_start();
session_destroy();

setcookie('invalido', 'verdade', time() - 360,'/');
setcookie('administrador', 'verdade', time() - 360,'/');
setcookie('medico', 'verdade', time() - 360,'/');
setcookie('medico_crm', '', time() - 360,'/');
setcookie('laboratorio', 'verdade', time() - 360,'/');
setcookie('laboratorio_cnpj', '', time() - 360,'/');
setcookie('paciente', 'verdade', time() - 360,'/');
setcookie('paciente_cpf', '', time() - 360,'/');

echo "<script>window.location.href='../index.php';</script>";
?>
