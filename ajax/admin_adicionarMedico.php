<?php
    include "../config/universal.php";
    include "../model/medico.php";

    if (isset($_POST['inputCrmMedico'])){
        $nome = $universal->testaEntrada($_POST['inputNomeMedico']);
        $endereco = $universal->testaEntrada($_POST['inputEnderecoMedico']);
        $telefone = $universal->testaEntrada($_POST['inputTelefoneMedico']);
        $email = $universal->testaEntrada($_POST['inputEmailMedico']);
        $genero = $universal->testaEntrada($_POST['inputGenderMedico']);
        $crm = $universal->testaEntrada($_POST['inputCrmMedico']);
        $especialidade = $universal->testaEntrada($_POST['inputEspecialidade']);
        $senha = $universal->testaEntrada($_POST['inputPasswordMedico']);

        #tratamento de entradas
        $crm = preg_replace("/[^0-9]/", "", $crm);

        $medico = new Medico;
        $medico = $medico->comArgumentos($nome, $endereco, $telefone, $email, $senha, $crm, $especialidade, $genero);
        #$universal->cadastraMedico($nome, $endereco, $telefone, $email, $genero, $crm, $especialidade, $senha);
    }
    echo "<script>window.location.href='../admin.php';</script>";

?>
