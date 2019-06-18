<?php 
    include "../config/universal.php";

    $universal = new universal;

    include "conexao.php";
    $nome = $_POST['inputName'];
    $endereco = $_POST['inputAddress'];
    $telefone = $_POST['inputTel'];
    $email = $_POST['inputEmail'];
    $genero = $_POST['inputGender'];
    $crm = $_POST['inputCrm'];
    $senha = $_POST['inputPassword'];
    $especialidade = $_POST['especialidade'];

    $universal->medico->comArgumentos($nome, $endereco, $telefone, $email, $senha, $crm, $especialidade, $genero);
    $universal->medico->alterarXML();
    $response = array("success" => true);
    echo json_encode($response);        

?>