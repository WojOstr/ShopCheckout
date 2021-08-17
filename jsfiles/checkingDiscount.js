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
                $('p.discountcomment').text("Wrong Code!");
                $('p.getdiscountcode').text('');
                $('p.discountcomment').css({'color' : 'red'});
            }
            else {
                $('p.discountcomment').text("Successfully Added Discount Code!");
                $('p.getdiscountcode').text(done +" %");
                $('p.discountcomment').css({'color' :'green'});
            }

        })
    })
    
});
