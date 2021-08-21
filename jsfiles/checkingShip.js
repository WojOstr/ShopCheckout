$(document).ready(function(){
    $('.myradio').change(function(){
        var shipvalue = $('input[name="ship"]:checked').val();
        $.ajax({
            type: "POST",
            url: "./phpfiles/checkShip.php",
            data: {ship: shipvalue},
            dataType:"json",
            encode:true,
        }).done(function(done){
            $('p.getshipprice').text(done);
        })
        .fail(function(data) {
            console.log( data);
          });
    })
    
});
