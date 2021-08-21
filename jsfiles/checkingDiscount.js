$(document).ready(function(){
    $('#discount').on('input',function(){
        var discount = $('input[name="discountcode"]').val();
        $.ajax({
            type: "POST",
            url: "./phpfiles/checkDiscount.php",
            data: {discount: discount},
            dataType:"json",
            encode:true,
        }).done(function(done){
            if (done == false){
                $('p.discountcomment').text("Zły kod! Cena nie zostanie obniżona");
                $('p.getdiscountcode').text('');
                $('p.discountcomment').css({'color' : 'red'});
            }
            else {
                $('p.discountcomment').text("Poprawny kod zniżkowy!");
                $('p.getdiscountcode').text(done +" %");
                $('p.discountcomment').css({'color' :'green'});
            }

        })
    })
    
});
