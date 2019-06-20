<?php
    session_start();
    include "../config/universal.php";

    $crm = $_POST['inputCrm'];
    $cpf = $_POST['inputCpf'];
    $data = $_POST['inputDate'];
    $receita = $_POST['inputReceita'];
    $requisicaoExame = $_POST['inputRequisicao'];
    $observacao = $_POST['inputObervacao'];

    echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
    //$universal->cadastraConsulta($crm, $cpf, $data, $receita, $requisicaoExame, $observacao);
    //echo "<script>window.location.href='../medico.php';</script>";
    
?>