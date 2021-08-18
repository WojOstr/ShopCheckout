$(document).ready(function(){

    
    $('#registerOrder').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $('#recaptcha').val(grecaptcha.getResponse());
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            encode: true,
        })
        .done(function(data3) {
            $(".formerrors").text('');
            console.log(data3)
            if($.isNumeric(data3)){
                $('#popupOrder').show();
                $('.orderid').text("Numer zamówienia: "+data3);
            }
            else {
                $.each(data3, function(index, value) {
                    if(value != null) {
                        $(".formerrors").append(value + '<br>');
                    }
                })
            }; 
        })
});
});
