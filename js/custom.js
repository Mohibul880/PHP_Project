
$(function(){
    setTimeout(function(){
        $(".alert").slideUp();
    }, 3000);
});


$(document).ready(function () {
    $('#photo').change(function (e) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    });
});
