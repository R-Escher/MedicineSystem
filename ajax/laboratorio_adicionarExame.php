<?php
    session_start();
    include "../config/universal.php";

    if (isset($_POST['inputCnpj'])){
        $cnpj = $_POST['inputCnpj'];
        $cpf = $_POST['inputCpf'];
        $data = $_POST['inputDate'];
        $exames = $_POST['inputExames'];
        $resultado = $_POST['inputResultado'];

        $universal->cadastraExame($data, $cnpj, $cpf, $exames, $resultado);
    }
    echo "<script>window.location.href='../laboratorio.php';</script>";
    
?>