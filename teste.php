<?php
ini_set('display_errors', 1);

include 'model/medico.php';

#$m = Medico::comArgumentos("Roberson", "rio grande", "8127-6614", "roberson...", "123456", "4412-2", "abençoar");
#$lista_medicos = $m->listaMedicos();
$medico = Medico::buscaMedico("4123-9");
var_dump($medico);

?>
