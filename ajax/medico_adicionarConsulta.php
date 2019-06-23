<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCrm'])){
        $crm = $universal->testaEntrada($_POST['inputCrm']);
        $cpf = $universal->testaEntrada($_POST['inputCpf']);
        $data = $universal->testaEntrada($_POST['inputDate']);
        $receita = $universal->testaEntrada($_POST['inputReceita']);
        $requisicaoExame = $universal->testaEntrada($_POST['inputRequisicao']);
        $observacao = $universal->testaEntrada($_POST['inputObervacao']);
    
        $universal->cadastraConsulta($crm, $cpf, $data, $receita, $requisicaoExame, $observacao);
    }
    echo "<script>window.location.href='../medico.php';</script>";
    
?>