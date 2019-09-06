<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    include_once $raiz.'/MedicineSystem/model/paciente.php';
    include_once $raiz.'/MedicineSystem/config/universal.php';

    $paciente = new Paciente();
    $response = $universal->testaEntrada($_POST['cpf']);
    $pessoa = $universal->testaEntrada($_POST['pessoa']);

	// Elimina possivel mascara
	$response = preg_replace("/[^0-9]/", "", $response);


	// Verifica se o numero de digitos informados é igual a 11
	if (strlen($response) != 11) {
        if ($pessoa=="admin"){
            echo true; #retorna errado
        }else{
            echo false;
        }
    }
    $paciente = $paciente->buscapaciente($response);

    if ($paciente->getCPF() == $response){
        echo true;
    }else{
        echo false;
    }

?>
