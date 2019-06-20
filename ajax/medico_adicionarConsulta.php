<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCrm'])){
        $crm = $_POST['inputCrm'];
        $cpf = $_POST['inputCpf'];
        $data = $_POST['inputDate'];
        $receita = $_POST['inputReceita'];
        $requisicaoExame = $_POST['inputRequisicao'];
        $observacao = $_POST['inputObervacao'];
    
        $universal->cadastraConsulta($crm, $cpf, $data, $receita, $requisicaoExame, $observacao);
    }
    echo "<script>window.location.href='../medico.php';</script>";
    
?>