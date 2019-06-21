<?php
    include '../model/paciente.php';
    $paciente = new Paciente;
    $response = $_POST['cpf'];
    $pessoa = $_POST['pessoa'];

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
