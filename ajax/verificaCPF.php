<?php
    include '../model/paciente.php';
    $paciente = new Paciente;
    $response = $_POST['cpf'];

    $paciente = $paciente->buscapaciente($response);

    if ($paciente->getCPF() == $response){
        echo true;
    }else{
        echo false;
    }

?>
