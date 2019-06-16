<?php
ini_set('display_errors', 1);

include 'model/medico.php';
include 'model/laboratorio.php';

#$m = Medico::comArgumentos("Roberson", "rio grande", "8127-6614", "roberson...", "123456", "4412-2", "abençoar");
#$lista_medicos = $m->listaMedicos();
$medico = Medico::buscaMedico("4123-9");
#$medico->deletarMedico();
#var_dump($medico);


#REALIZAR ALTERAÇÃO NO MEDICO NO XML
$medico->setNome("Roberson");
$medico->alterarXML();

#$l = new Laboratorio();
#$lista_laboratorios = $l->listaLaboratorios();
#var_dump($lista_laboratorios[0]->getTipos_exames());


?>
