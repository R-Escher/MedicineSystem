<?php 
    session_start();
    include "../config/universal.php";
    include "../model/paciente.php";

    if(isset($_POST['inputCpf'])){
        $nome = $_POST['inputName'];
        $endereco = $_POST['inputAddress'];
        $telefone = $_POST['inputTel'];
        $email = $_POST['inputEmail'];
        $idade = $_POST['inputAge'];
        $genero = $_POST['inputGender'];
        $cpf = $_POST['inputCpf'];
        $senha = $_POST['inputPassword'];

    
        $paciente = new Paciente;
        $alterapaciente = $paciente->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cpf, $idade, $genero);
        $alterapaciente->alterarXML(); 
    }
    
    echo "<script>window.location.href='../paciente.php';</script>";
?>