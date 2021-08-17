$(document).ready(function(){

    
    $('#registerOrder').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize()
        console.log(data)
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            encode: true,
        })
        .done(function(data2) {
            console.log(data2)
            if($.isNumeric(data2)){
                $('#popupOrder').show();
                $('.orderid').text("Numer zamówienia: "+data2);
            }
            else {
                $('.formerrors').text(data2);
            }; 
        })
});
});
