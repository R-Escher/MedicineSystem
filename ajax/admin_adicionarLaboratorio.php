<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCnpjLaboratorio'])){
        $nome = $_POST['inputNomeLaboratorio'];
        $endereco = $_POST['inputEnderecoLaboratorio'];
        $telefone = $_POST['inputTelefoneLaboratorio'];
        $email = $_POST['inputEmailLaboratorio'];
        $cnpj = $_POST['inputCnpjLaboratorio'];
        $tiposExames = $_POST['inputTiposExames'];
        $senha = $_POST['inputPasswordLaboratorio'];

        $lab = new Laboratorio;
        $lab = $lab->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cnpj, $tiposExames);
        #$universal->cadastraLaboratorio($nome, $endereco, $telefone, $email, $cnpj, $tiposExames, $senha);
    }
    echo "<script>window.location.href='../admin.php';</script>";
    
?>