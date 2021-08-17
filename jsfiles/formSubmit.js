$(document).ready(function(){

    
    $('#registerOrder').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var recaptchaResponse = grecaptcha.getResponse();
        var data = $(this).serialize()
        var data2 = data + '&recaptchaResponse='+recaptchaResponse;
        console.log(data2)
        $.ajax({
            type: "POST",
            url: url,
            data: data2,
            dataType: "json",
            encode: true,
        })
        .done(function(data3) {
            console.log(data3)
            if($.isNumeric(data3)){
                $('#popupOrder').show();
                $('.orderid').text("Numer zamówienia: "+data3);
            }
            else {
                $('.formerrors').text(JSON.stringify(data3));
            }; 
        })
});
});
