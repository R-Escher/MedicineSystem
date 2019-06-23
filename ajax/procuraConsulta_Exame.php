<?php
    include '../config/universal.php';
    include '../model/paciente.php';
    $universal = new universal;
    $paciente = new Paciente;
    $nome = $universal->testaEntrada($_POST['nome']);

    if (isset($_POST['crm'])){
        $crm = $universal->testaEntrada($_POST['crm']);
        $consultas_exames = $universal->procurarConsultas($nome, $crm);
    }elseif (isset($_POST['cnpj'])){
        $cnpj = $universal->testaEntrada($_POST['cnpj']);
        $consultas_exames = $universal->procurarExames($nome, $cnpj);
    }

    if ($consultas_exames !== null){
        echo $consultas_exames;
    }else{
        echo false;
    }
    

?>