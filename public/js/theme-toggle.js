$(document).ready(function () {
    $(function () {
        $("#theme-button").click(function () {
            $("#theme-menu").show();
            $(document).on("click", function () {
                $("#theme-menu").hide();
            });
            $(".theme-color").on("click", function () {
                var id = $(this).attr("id");
                $("#theme-style").attr("href", "/public/css/" + id + ".css");
            });
            return false;
        })
    });
});