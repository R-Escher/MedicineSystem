<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    include_once $raiz.'/MedicineSystem/model/paciente.php';
    include_once $raiz.'/MedicineSystem/config/universal.php';

    if(isset($_POST['inputCpf'])){
        $nome = $universal->testaEntrada($_POST['inputName']);
        $endereco = $universal->testaEntrada($_POST['inputAddress']);
        $telefone = $universal->testaEntrada($_POST['inputTel']);
        $email = $universal->testaEntrada($_POST['inputEmail']);
        $idade = $universal->testaEntrada($_POST['inputAge']);
        $genero = $universal->testaEntrada($_POST['inputGender']);
        $cpf = $universal->testaEntrada($_POST['inputCpf']);
        $senha = $universal->testaEntrada($_POST['inputPassword']);


        $paciente = new Paciente;
        $alterapaciente = $paciente->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cpf, $idade, $genero);
        $alterapaciente->alterarXML();
    }

    echo "<script>window.location.href='../paciente.php';</script>";
?>
