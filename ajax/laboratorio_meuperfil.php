<?php 
    session_start();
    include "../config/universal.php";
    include "../model/laboratorio.php";

    if(isset($_POST['inputCnpj'])){
        $nome = $universal->testaEntrada($_POST['inputName']);
        $endereco = $universal->testaEntrada($_POST['inputAddress']);
        $telefone = $universal->testaEntrada($_POST['inputTel']);
        $email = $universal->testaEntrada($_POST['inputEmail']);
        $cnpj = $universal->testaEntrada($_POST['inputCnpj']);
        $senha = $universal->testaEntrada($_POST['inputPassword']);
        $exames = $universal->testaEntrada($_POST['inputExames']);

        $lab = new Laboratorio;
        $alteraLaboratorio = $lab->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cnpj, $exames);
        $alteraLaboratorio->alterarXML();

    }

    echo "<script>window.location.href='../laboratorio.php';</script>";
?>
