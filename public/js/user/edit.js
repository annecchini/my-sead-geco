$(document).ready(function () {
    console.log("running page ready scripts...");

    //Exibir password se cpCheck for true.
    if ($("#cpCheck").prop("checked") === true) {
        $("#optionalPassword").collapse("show");
    }

    //seletize on person select.
    $("#personInput").selectize({ create: false, sortField: "text" });
});
