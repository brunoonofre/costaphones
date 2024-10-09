$(function(){
   
    var errordiv = $("#errordiv");
    var error = $("#error");
    var successdiv = $("#successdiv");
    var success = $("#success");
    var button = $("#addaddressbtn");
    
    errordiv.hide();
    successdiv.hide();
    
    $("input").keypress(function(event){
        if(event.which==13){
            button.click();
        } 
        
    });
    
    button.click(function(){
        
        if($('input[name=street]').val() == '' ||$('input[name=city]').val() == '' ||$('input[name=state]').val() == '' || $('select[name=country]').val() == '' || $('input[name=zip]').val() == '' || $('input[name=phone]').val() == ''){
            successdiv.slideUp();
            errordiv.slideDown();
            error.html("Deve preencher todos os campos!");
            return false;
        }else{

            var id = $('input[name=userid]').val();
            var street = $('input[name=street]').val();
            var city = $('input[name=city]').val();
            var state = $('input[name=state]').val();
            var country = $('select[name=country]').val();
            var zip = $('input[name=zip]').val();
            var phone = $('input[name=phone]').val();
            
            post_data = {
                'id': id,
                'street': street,
                'city': city,
                'state': state,
                'country': country,
                'zip': zip,
                'phone': phone
            };

            
            $.ajax({
                type: 'post',
                url: 'includes/add_address.php',
                data: post_data,
                dataType: 'json',
                error: function(xhr, ajaxOptions, thrownError){
                    alert("Error:\n" + thrownError);
                },
                success: function(response){
                    if(response.success == false){
                        successdiv.slideUp();
                        errordiv.slideDown();
                        error.html(response.text);
                    }else{
                        errordiv.slideUp();
                        location = 'user?success='+response.text;
                    }
                }
            });
            
        }
        
    });
    
});