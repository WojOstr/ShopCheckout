$(document).ready(function(){
    $('#discount').on('input',function(){
        var discount = $('input[name="discountcode"]').val();
        console.log(discount);
        $.ajax({
            type: "POST",
            url: "./phpfiles/checkDiscount.php",
            data: {discount: discount},
            dataType:"json",
            encode:true,
        }).done(function(done){
            $('p.discountcomment').text("Successfully Added Discount Code!");
            $('p.getdiscountcode').text(done +" %");
            $('p.discountcomment').css({'color' :'green'});
        })
        .fail(function(data) {
            $('p.discountcomment').text("Wrong Code!");
            $('p.discountcomment').css({'color' : 'red'});
          });
    })
    
});
