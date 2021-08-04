$(document).ready(function(){
    $( '#register' ).click(function() {
        if($( '.hiddenRegister' ).is(":visible")){
            $( '.hiddenRegister' ).toggle("slow");
            $( '#register').prop('checked', false);
        } else{
            $( '.hiddenRegister' ).toggle("slow");
            $( '#register').prop('checked', true);
        }

    });
});

