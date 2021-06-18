$(document).ready(function () {
    console.log("running page scripts...");
    Inputmask({ mask: "999.999.999-99" }).mask($("#cpfInput"));
});
