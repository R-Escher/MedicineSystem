$("#medicos").hide();$("#laboratorios").hide();
$("#pacientescadastrados-toggle").click(function(f) {
    $("#pacientes").show();
    $("#medicos").hide();$("#laboratorios").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#medicoscadastrados-toggle").click(function(f) {
    $("#pacientes").hide();$("#laboratorios").hide();
    $("#medicos").show();
    $("#wrapper").toggleClass("toggled");
});
$("#laboratorioscadastrados-toggle").click(function(f) {
    $("#pacientes").hide();$("#medicos").hide();
    $("#laboratorios").show();
    $("#wrapper").toggleClass("toggled");
});

// ADICIONA PACIENTE
$("#inputCpfPaciente").change(function(){

    var teste = 'cpf=' + String($("#inputCpfPaciente").val());
    $.ajax({
        type: "POST",
        url: 'ajax/verificaCPF.php',
        async: true,
        data: teste,
        success: function (response) {
            if (response == false){
                $('#admin_adicionarPaciente').attr("disabled", false);
                $("#validarCPF").hide();                
            }else if(response == true){
                $('#admin_adicionarPaciente').attr("disabled", true);
                $("#validarCPF").show();
            }
        },
        error: function () {
            
        },
    });    
});

// ADICIONA MEDICO
$("#inputCrmMedico").change(function(){

    var teste = 'crm=' + String($("#inputCrmMedico").val());
    $.ajax({
        type: "POST",
        url: 'ajax/verificaCRM.php',
        async: true,
        data: teste,
        success: function (response) {
            if (response == false){
                $('#admin_adicionarMedico').attr("disabled", false);
                $("#validarCRM").hide();                
            }else if(response == true){
                $('#admin_adicionarMedico').attr("disabled", true);
                $("#validarCRM").show();
            }
        },
        error: function () {
            
        },
    });    
});

// ADICIONA LABORATORIO
$("#inputCnpjLaboratorio").change(function(){

    var teste = 'cnpj=' + String($("#inputCnpjLaboratorio").val());
    $.ajax({
        type: "POST",
        url: 'ajax/verificaCNPJ.php',
        async: true,
        data: teste,
        success: function (response) {
            if (response == false){
                $('#admin_adicionarLaboratorio').attr("disabled", false);
                $("#validarCPF").hide();                
            }else if(response == true){
                $('#admin_adicionarLaboratorio').attr("disabled", true);
                $("#validarCPF").show();
            }
        },
        error: function () {
            
        },
    });    
});

// PESQUISA PACIENTE
$("#admin_procurarPaciente").click(function(f) {

    var teste = 'nomePaciente=' + String($("#inputPesquisa").val());
    $.ajax({
        type: "POST",
        url: 'ajax/admin_procuraPacienteMedicoLaboratorio.php',
        async: true,
        data: teste,
        success: function (response) {
            $consultas = response;
            if ($consultas != false){
                $("#mostraPacientes").html($consultas);
            }else{
                alert("Não foram encontradas nomes contendo esses caracteres!");
                $("#inputPesquisa").val('');
            }
        },
        error: function () {
            
        },
    });

});

// PESQUISA MÉDICO
$("#admin_procurarMedico").click(function(f) {

    var teste = 'nomeMedico=' + String($("#inputPesquisa").val());
    $.ajax({
        type: "POST",
        url: 'ajax/admin_procuraPacienteMedicoLaboratorio.php',
        async: true,
        data: teste,
        success: function (response) {
            $consultas = response;
            if ($consultas != false){
                $("#mostraMedicos").html($consultas);
            }else{
                alert("Não foram encontradas nomes contendo esses caracteres!");
                $("#inputPesquisa").val('');
            }
        },
        error: function () {
            
        },
    });

});

// PESQUISA LABORATÓRIO
$("#admin_procurarLaboratorio").click(function(f) {

    var teste = 'nomeLaboratorio=' + String($("#inputPesquisa").val());
    $.ajax({
        type: "POST",
        url: 'ajax/admin_procuraPacienteMedicoLaboratorio.php',
        async: true,
        data: teste,
        success: function (response) {
            $consultas = response;
            if ($consultas != false){
                $("#mostraLaboratorios").html($consultas);
            }else{
                alert("Não foram encontradas nomes contendo esses caracteres!");
                $("#inputPesquisa").val('');
            }
        },
        error: function () {
            
        },
    });

});