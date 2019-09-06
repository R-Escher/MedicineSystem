
// diferencia janelas de login entre os usuarios
$("#paciente-login").show(); $("#medico-login").hide(); $("#laboratorio-login").hide(); $("#admin-login").hide();
$("#paciente-toggle").click(function(f) {
    $("#paciente-login").show();
    $("#medico-login").hide();
    $("#laboratorio-login").hide();
    $("#admin-login").hide();
    $("#wrapper").toggleClass("toggled");
    
});
$("#medico-toggle").click(function(f) {
    $("#paciente-login").hide();
    $("#medico-login").show();
    $("#laboratorio-login").hide();
    $("#admin-login").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#laboratorio-toggle").click(function(f) {
    $("#paciente-login").hide();
    $("#medico-login").hide();
    $("#laboratorio-login").show();
    $("#admin-login").hide();
    $("#wrapper").toggleClass("toggled");
});
$("#admin-toggle").click(function(f) {
    $("#paciente-login").hide();
    $("#medico-login").hide();
    $("#laboratorio-login").hide();
    $("#admin-login").show();
    $("#wrapper").toggleClass("toggled");
}); 