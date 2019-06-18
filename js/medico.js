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

    
    //$("#inputConfirmaPassword").val('adadsa');
    //$("inputConfirmaPassword").removeAttr('disabled');


    