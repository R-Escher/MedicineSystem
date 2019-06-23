<?php
    include '../config/universal.php';
    #include '../model/paciente.php';
    #include '../model/medico.php';
    #include '../model/laboratorio.php';
    $universal = new universal;
    #$paciente = new Paciente;
    #$medico = new Medico;
    #$laboratorio = new Laboratorio;
    #$nome = $_POST['nome'];

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