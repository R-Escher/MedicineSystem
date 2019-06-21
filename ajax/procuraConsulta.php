<?php
    include '../config/universal.php';
    include '../model/paciente.php';
    $universal = new universal;
    $paciente = new Paciente;
    $nome = $_POST['nome'];
    $crm = $_POST['crm'];

    $consultas = $universal->procurarConsultas($nome, $crm);

    if ($consultas !== null){
        echo $consultas;
    }else{
        echo false;
    }
    

?>