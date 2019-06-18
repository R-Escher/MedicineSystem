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
$("#inputPassword").keypress(function(f){
    if($("#inputPassword").val() != '' ){
        $("#inputConfirmaPassword").removeAttr('disabled');
        $("#inputPassword").attr('required','required');
        $("#inputConfirmaPassword").attr('required','required');
    }
    if($("#inputPassword").val() == '' ){
        $("#inputConfirmaPassword").attr('disabled','disabled');
    }
});

$('#medico_meuperfil_submit').click(function() {
 
    var dados = $('#form_meuperfil').serialize();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'medico_meuperfil.php',
        async: true,
        data: dados,
        success: function(response) {
            location.reload();
        }
    });

    return false;
});
 

    