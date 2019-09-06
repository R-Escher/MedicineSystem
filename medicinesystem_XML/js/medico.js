$("#meuperfil").hide();
$("#consultas-toggle").click(function(f) {
    $("#consultas").show();
    $("#meuperfil").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#meuperfil-toggle").click(function(f) {
    $("#consultas").hide();
    $("#meuperfil").show();
    $("#wrapper").toggleClass("toggled");
});

// PESQUISA CONSULTA
$("#medico_procurarConsulta").click(function(f) {

    var teste = 'nome=' + String($("#inputPesquisa").val()) + '&crm=' + String($("#inputCrm").val());
    $.ajax({
        type: "POST",
        url: 'ajax/procuraConsulta_Exame.php',
        async: true,
        data: teste,
        success: function (response) {
            $consultas = response;
            if ($consultas != false){
                $("#mostraConsultas").html($consultas);
            }else{
                alert("Não foram encontradas nomes contendo esses caracteres!");
                $("#inputPesquisa").val('');
            }
        },
        error: function () {
            
        },
    });

});


$("#inputCpf").change(function(){

    var teste = 'cpf=' + String($("#inputCpf").val())+'&pessoa='+'medico';
    $.ajax({
        type: "POST",
        url: 'ajax/verificaCPF.php',
        async: true,
        data: teste,
        success: function (response) {
            if (response == false){
                $('#medico_adicionarConsulta').attr("disabled", true);
                $("#validarCPF").show();
            }else if(response == true){
                $('#medico_adicionarConsulta').attr("disabled", false);
                $("#validarCPF").hide();
            }
        },
        error: function () {
            $('#validarCPF').html('Bummer: there was an error!');
        },
    });    

});
 

    