$(window).on('load',function(){
        $('#centralModalSm').modal('show');
    });

$("#centralModalSm").on('hide.bs.modal', function(){
    window.location = "index.php"
});