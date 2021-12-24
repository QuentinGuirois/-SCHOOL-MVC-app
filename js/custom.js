$(document).ready(function () {
    if(window.location.href.indexOf("controller=Prospects&action=update") > -1) {
    $("#boutonTransfert").css("display", "block")
   } else {
    $("#boutonTransfert").css("display", "none")
   }
 });