$(document).ready(function () {
    console.log("running page scripts...");

    //Exibir password se cpCheck for true.
    if ($("#cpCheck").prop("checked") === true) {
        $("#optionalPassword").collapse("show");
    }
});
