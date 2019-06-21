<?php
    include '../model/medico.php';
    $medico = new Medico;
    $response = $_POST['crm'];

    $medico = $medico->buscaMedico($response);

    if ($medico->getCRM() == $response){
        echo true;
    }else{
        echo false;
    }

?>
