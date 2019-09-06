$("#meuperfil").hide();$("#exames").hide();
$("#consultas-toggle").click(function(f) {
    $("#consultas").show();
    $("#meuperfil").hide();$("#exames").hide();
    $("#wrapper").toggleClass("toggled");
});

$("#meuperfil-toggle").click(function(f) {
    $("#consultas").hide();$("#exames").hide();
    $("#meuperfil").show();
    $("#wrapper").toggleClass("toggled");
});
$("#exames-toggle").click(function(f) {
    $("#consultas").hide();$("#meuperfil").hide();
    $("#exames").show();
    $("#wrapper").toggleClass("toggled");
});