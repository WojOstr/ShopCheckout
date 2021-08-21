$(document).ready(function(){
   $('body').on('DOMSubtreeModified', '#partSumPrice', function(){
        var discount = $('input[name="discountcode"]').val();
        var productid = 1;
        var shippment = $('input[name="ship"]:checked').val();
        var quantity = 1;
        $.ajax({
            type: "POST",
            url: "./phpfiles/calculatePrice.php",
            data: {discount: discount,
            productid: productid,
            shippment: shippment,
            quantity: quantity},
            dataType:"json",
            encode:true,
        }).done(function(done){
            $('p#wholeSumText').text(done);
        })
        .fail(function(data) {
            console.log( data);
          });
    })
    
});

