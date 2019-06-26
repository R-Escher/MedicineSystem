<?php
    session_start();
    include "../config/universal.php";
    include "../model/paciente.php";

    if (isset($_POST['inputCpfPaciente'])){
        $nome = $universal->testaEntrada($_POST['inputNomePaciente']);
        $endereco = $universal->testaEntrada($_POST['inputEnderecoPaciente']);
        $telefone = $universal->testaEntrada($_POST['inputTelefonePaciente']);
        $email = $universal->testaEntrada($_POST['inputEmailPaciente']);
        $genero = $universal->testaEntrada($_POST['inputGenderPaciente']);
        $idade = $universal->testaEntrada($_POST['inputAgePaciente']);
        $cpf = $universal->testaEntrada($_POST['inputCpfPaciente']);
        $senha = $universal->testaEntrada($_POST['inputPasswordPaciente']);

        #tratamento de entradas
        $cpf = preg_replace("/[^0-9]/", "", $cpf);

        $paciente = new Paciente;
        $paciente = $paciente->comArgumentos($nome, $endereco, $telefone, $email, $senha, $cpf, $idade, $genero);
        #$universal->cadastraPaciente($nome, $endereco, $telefone, $email, $genero, $idade, $cpf, $senha);
    }
    echo "<script>window.location.href='../admin.php';</script>";

?>
