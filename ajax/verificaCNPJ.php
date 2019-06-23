<?php
    include '../model/laboratorio.php';
    $laboratorio = new Laboratorio;
    $response = $universal->testaEntrada($_POST['cnpj']);

	// Elimina possivel mascara
	$response = preg_replace("/[^0-9]/", "", $response);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($response) != 14) {
        echo true;
    }

    $laboratorio = $laboratorio->buscaLaboratorio($response);

    if ($laboratorio->getCNPJ() == $response){
        echo true;
    }else{
        echo false;
    }

?>
