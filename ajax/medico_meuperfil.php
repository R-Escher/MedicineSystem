<?php 
    session_start();
    include "../config/universal.php";
    include "../model/medico.php";

    //$universal = new universal;

    $nome = $_POST['inputName'];
    $endereco = $_POST['inputAddress'];
    $telefone = $_POST['inputTel'];
    $email = $_POST['inputEmail'];
    $genero = $_POST['inputGender'];
    $crm = $_POST['inputCrm'];
    $senha = $_POST['inputPassword'];
    $especialidade = $_POST['inputEspecialidade'];

    $medico = new Medico;
    $alteraMedico = $medico->comArgumentos($nome, $endereco, $telefone, $email, $senha, $crm, $especialidade, $genero);
    $alteraMedico->alterarXML();    
    
    echo "<script>window.location.href='../medico.php';</script>";
?>