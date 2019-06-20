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
                $('#medico_adicionarConsulta').attr("disabled", true);
                $("#validarCPF").show();
            }else if(response == true){
                $('#medico_adicionarConsulta').attr("disabled", false);
                $("#validarCPF").hide();
            }
        },
        error: function () {
            $('#inputObervacao').html('Bummer: there was an error!');
        },
    });    

});
    function validaCPF(f){

        return false;    

    }


/*$("#inputPassword").keypress(function(f){
    if($("#inputPassword").val() != '' ){
        $("#inputConfirmaPassword").removeAttr('disabled');
        $("#inputConfirmaPassword").attr('required','required');
    }
});*/

 

    