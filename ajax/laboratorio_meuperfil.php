<?php 
    session_start();
    include "../config/universal.php";
    include "../model/laboratorio.php";
    
    if(isset($_POST['inputCnpj'])){
        $nome = $_POST['inputName'];
        $endereco = $_POST['inputAddress'];
        $telefone = $_POST['inputTel'];
        $email = $_POST['inputEmail'];
        $crm = $_POST['inputCnpj'];
        $senha = $_POST['inputPassword'];
        $exames = $_POST['inputExames'];

        $lab = new Laboratorio;
        $alteraLaboratorio = $lab->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cnpj, $exames);
        $alteraLaboratorio->alterarXML();   

    }

    echo "<script>window.location.href='../laboratorio.php';</script>";
?>