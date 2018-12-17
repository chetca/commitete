jQuery(document).ready(function(){
    $('body').on('change', '#w1', function(){
        $('#submit').prop("disabled", !this.checked);
    });
});