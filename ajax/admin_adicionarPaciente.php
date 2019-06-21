<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCpfPaciente'])){
        $nome = $_POST['inputNomePaciente'];
        $endereco = $_POST['inputEnderecoPaciente'];
        $telefone = $_POST['inputTelefonePaciente'];
        $email = $_POST['inputEmailPaciente'];
        $genero = $_POST['inputGenderPaciente'];
        $idade = $_POST['inputAgePaciente'];
        $cpf = $_POST['inputCpfPaciente'];
        $senha = $_POST['inputPasswordPaciente'];

        $paciente = new Paciente;
        $paciente = $paciente->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cpf, $idade, $genero);
        #$universal->cadastraPaciente($nome, $endereco, $telefone, $email, $genero, $idade, $cpf, $senha);
    }
    echo "<script>window.location.href='../admin.php';</script>";
    
?>