<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCnpj'])){
        $cnpj = $universal->testaEntrada($_POST['inputCnpj']);
        $cpf = $universal->testaEntrada($_POST['inputCpf']);
        $data = $universal->testaEntrada($_POST['inputDate']);
        $exames = $universal->testaEntrada($_POST['inputExames']);
        $resultado = $universal->testaEntrada($_POST['inputResultado']);

        $universal->cadastraExame($data, $cnpj, $cpf, $exames, $resultado);
    }
    echo "<script>window.location.href='../laboratorio.php';</script>";
    
?>