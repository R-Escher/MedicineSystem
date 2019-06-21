$("#meuperfil").hide();
$("#exames-toggle").click(function(f) {
    $("#exames").show();
    $("#meuperfil").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#meuperfil-toggle").click(function(f) {
    $("#exames").hide();
    $("#meuperfil").show();
    $("#wrapper").toggleClass("toggled");
});

// PESQUISA EXAMES
$("#lab_procurarExame").click(function(f) {

    var teste = 'nome=' + String($("#inputPesquisa").val()) + '&cnpj=' + String($("#inputCnpj").val());
    $.ajax({
        type: "POST",
        url: 'ajax/procuraConsulta_Exame.php',
        async: true,
        data: teste,
        success: function (response) {
            $exames = response;
            if ($exames != false){
                $("#mostraExames").html($exames);
            }else{
                alert("Não foram encontrados nomes contendo esses caracteres!");
                $("#inputPesquisa").val('');
            }
        },
        error: function () {
        
        },
    });

});

// MEU PERFIL onkeypress="validaCPF(this.value)"
$("#inputCpf").change(function(){

    var teste = 'cpf=' + String($("#inputCpf").val());
    $.ajax({
        type: "POST",
        url: 'ajax/verificaCPF.php',
        async: true,
        data: teste,
        success: function (response) {
            if (response == false){
                $('#lab_adicionarExame').attr("disabled", true);
                $("#validarCPF").show();
            }else if(response == true){
                $('#lab_adicionarExame').attr("disabled", false);
                $("#validarCPF").hide();
            }
        },
        error: function () {
            $('#validarCPF').html('Bummer: there was an error!');
        },
    });    

});
 

    