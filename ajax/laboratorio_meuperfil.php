<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    include_once $raiz.'/MedicineSystem/model/laboratorio.php';
    include_once $raiz.'/MedicineSystem/config/universal.php';

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
