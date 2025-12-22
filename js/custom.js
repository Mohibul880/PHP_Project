
$(function(){
    setTimeout(function(){
        $(".alert").slideUp();
    }, 3000);
});



$(function () {

    // alert hide
    setTimeout(function () {
        $(".alert").slideUp();
    }, 3000);

    // image preview
    $("#photo").on("change", function () {
        let file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

});



