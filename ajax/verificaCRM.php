<?php
    include '../model/medico.php';
    $medico = new Medico;
    $response = $_POST['crm'];

	// Elimina possivel mascara
	$response = preg_replace("/[^0-9]/", "", $response);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($response) != 6) {
        echo true;
    }

    $medico = $medico->buscaMedico($response);

    if ($medico->getCRM() == $response){
        echo true;
    }else{
        echo false;
    }

?>
