<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    include_once $raiz.'/MedicineSystem/model/medico.php';
    include_once $raiz.'/MedicineSystem/config/universal.php';

    if(isset($_POST['inputCrm'])){
        $nome = $universal->testaEntrada($_POST['inputName']);
        $endereco = $universal->testaEntrada($_POST['inputAddress']);
        $telefone = $universal->testaEntrada($_POST['inputTel']);
        $email = $universal->testaEntrada($_POST['inputEmail']);
        $genero = $universal->testaEntrada($_POST['inputGender']);
        $crm = $universal->testaEntrada($_POST['inputCrm']);
        $senha = $universal->testaEntrada($_POST['inputPassword']);
        $especialidade = $universal->testaEntrada($_POST['inputEspecialidade']);

        $medico = new Medico;
        $alteraMedico = $medico->comArgumentos($nome, $endereco, $telefone, $email, $senha, $crm, $especialidade, $genero);
        $alteraMedico->alterarXML();

    }

    echo "<script>window.location.href='../medico.php';</script>";
?>
