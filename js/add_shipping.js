$(function(){
    
    var errordiv = $("#errordiv");
    var errormsg = $("#error");
    var countryf = $("#country");
    var shipcostf = $("#shipcost");
    var button = $("#btnaddshipping"); 
   
    errordiv.hide();
    
    button.click(function(){
        
        if (countryf.val() == "" || shipcostf.val() <= 0){
            errordiv.slideDown();
            errormsg.html("Deve preencher todos os campos!");
            return false;
        }else{
            
            var country = $('input[name=country]').val();
            var shipcost = $('input[name=shipcost]').val();

            post_data = {
                'country': country,
                'shipcost': shipcost
            };

            $.ajax({
                type: 'post',
                url: 'includes/add_shipping.php',
                data: post_data,
                dataType: 'json',
                error: function(xhr, ajaxOptions, thrownError){
                    alert("Error:\n" + thrownError);
                },
                success: function(response){
                    if(response.success == false){
                        errordiv.slideDown();
                        errormsg.html(response.text);
                    }else{
                        button.click(function(){});
                        window.location = 'shipping?success=New location saved!';
                    }
                }
            });
        }
    });
    
    $(".form-group").keypress(function(event){
        if(event.which==13){
            button.click();
        } 
        
    });
    
});