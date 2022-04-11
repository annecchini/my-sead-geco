$(document).ready(function () {
    console.log("running page ready scripts...");
    Inputmask({ mask: "999.999.999-99" }).mask($("#cpfInput"));
});
