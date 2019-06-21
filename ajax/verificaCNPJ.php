<?php
    include '../model/laboratorio.php';
    $laboratorio = new Laboratorio;
    $response = $_POST['cnpj'];

    $laboratorio = $laboratorio->buscaLaboratorio($response);

    if ($laboratorio->getCNPJ() == $response){
        echo true;
    }else{
        echo false;
    }

?>
