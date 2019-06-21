<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCrmMedico'])){
        $nome = $_POST['inputNomeMedico'];
        $endereco = $_POST['inputEnderecoMedico'];
        $telefone = $_POST['inputTelefoneMedico'];
        $email = $_POST['inputEmailMedico'];
        $genero = $_POST['inputGenderMedico'];
        $crm = $_POST['inputCrmMedico'];
        $especialidade = $_POST['inputEspecialidade'];
        $senha = $_POST['inputPasswordMedico'];

        $medico = new Medico;
        $medico = $medico->comArgumentos($nome, $endereco, $telefone, $email, $senha, $crm, $especialidade, $genero);
        #$universal->cadastraMedico($nome, $endereco, $telefone, $email, $genero, $crm, $especialidade, $senha);
    }
    echo "<script>window.location.href='../admin.php';</script>";
    
?>