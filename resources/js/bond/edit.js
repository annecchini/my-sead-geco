$(document).ready(function () {
    console.log("running page ready scripts...");
    $("#personInput").selectize({ create: false, sortField: "text" });
    $("#ocupationInput").selectize({ create: false, sortField: "text" });
    $("#courseInput").selectize({ create: false, sortField: "text" });
    $("#poleInput").selectize({ create: false, sortField: "text" });
});
