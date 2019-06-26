<?php
    session_start();
    include "../config/universal.php";
    include "../model/laboratorio.php";

    if (isset($_POST['inputCnpjLaboratorio'])){
        $nome = $universal->testaEntrada($_POST['inputNomeLaboratorio']);
        $endereco = $universal->testaEntrada($_POST['inputEnderecoLaboratorio']);
        $telefone = $universal->testaEntrada($_POST['inputTelefoneLaboratorio']);
        $email = $universal->testaEntrada($_POST['inputEmailLaboratorio']);
        $cnpj = $universal->testaEntrada($_POST['inputCnpjLaboratorio']);
        $tiposExames = $universal->testaEntrada($_POST['inputTiposExames']);
        $senha = $universal->testaEntrada($_POST['inputPasswordLaboratorio']);

        #tratamento de entradas
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

        $lab = new Laboratorio;
        $lab = $lab->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cnpj, $tiposExames);
        #$universal->cadastraLaboratorio($nome, $endereco, $telefone, $email, $cnpj, $tiposExames, $senha);
    }
    echo "<script>window.location.href='../admin.php';</script>";

?>
