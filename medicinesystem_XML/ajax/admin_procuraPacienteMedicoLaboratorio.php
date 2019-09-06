<?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    include_once $raiz.'/MedicineSystem/config/universal.php';

    if (isset($_POST['nomePaciente'])){
        $nome =$universal->testaEntrada($_POST['nomePaciente']);
        $result = $universal->procurarPacientes($nome);
    }elseif (isset($_POST['nomeMedico'])){
        $nome =$universal->testaEntrada($_POST['nomeMedico']);
        $result = $universal->procurarMedicos($nome);
    }elseif (isset($_POST['nomeLaboratorio'])){
        $nome =$universal->testaEntrada($_POST['nomeLaboratorio']);
        $result = $universal->procurarLaboratorios($nome);
    }

    if ($result !== null){
        echo $result;
    }else{
        echo false;
    }


?>
