<?php 
    include "conexao.php";
    $nome = $_POST['inputName'];
    $email = $_POST['inputAddress'];
    $senha = $_POST['inputTel'];
    $senha = $_POST['inputEmail'];
    $senha = $_POST['inputGender'];
    $senha = $_POST['inputCrm'];
    #$senha = $_POST['inputPassword'];
    #$senha = $_POST['inputConfirmaPassword'];


    $sql = "INSERT INTO usuario (NOME, EMAIL, SENHA) VALUES ('$nome', '$email', '$senha')";
    mysql_query($sql) or die(error());
    $response = array("success" => true);
    echo json_encode($response);
?>