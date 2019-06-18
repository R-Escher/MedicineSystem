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

// MEU PERFIL
/*$("#inputPassword").keypress(function(f){
    if($("#inputPassword").val() != '' ){
        $("#inputConfirmaPassword").removeAttr('disabled');
        $("#inputConfirmaPassword").attr('required','required');
    }
});*/

$('#medico_meuperfil_submit').click(function() {
 
    var dados = $('#form_meuperfil').serialize();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'ajax/medico_meuperfil.php',
        async: true,
        data: dados,
        success: function(response) {
            location.reload();
        }
    });

    return false;
});
 

    