$(document).ready(function(){
    $( '#register' ).click(function() {
        if($( '.hiddenRegister' ).is(":visible")){
            $( '.hiddenRegister' ).hide();
            $( '#register').prop('checked', false);
        } else{
            $( '.hiddenRegister' ).show();
            $( '#register').prop('checked', true);
        }

    });
});

