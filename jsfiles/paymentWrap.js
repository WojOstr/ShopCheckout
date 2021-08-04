$(document).ready(function(){
    if($(".myradio").change(function(){
        if($('#dpdp').is(':checked')){
            if($('.shipLocal').not(':visible')){
                $('.shipLocal').show();
            }
            if($('.shipOnline').is(':visible') && $('.shipBox').is(':visible')){
                $('#inhand').prop('checked', false);
                $('#payu').prop('checked', false);
                $('.shipOnline').hide();
                $('.shipBox').hide();

            }
           
        }
        if($('#dpd').is(':checked') || $('#inpost').is(':checked')) {
            if($('.shipLocal').is(':visible')){
                $('#traditional').prop('checked', false);
                $('.shipLocal').hide();
                
            }
            if($('.shipBox').not(':visible')) {
                $('.shipBox').show();
            }
            if($('shipOnline').not(':visible')) {
                $('.shipOnline').show();
            }
        }
    }));
});