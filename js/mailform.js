$(function(){
   
    var button = $("#btnmessage");
    var success = $("#success");
    var successdiv = $("#successdiv");
    
    successdiv.hide();
    
    $("input").keypress(function(event){
        if(event.which==13){
            button.click();
        } 
        
    });
    
    button.click(function(){
        
        var name = $('input[name=name]').val();
        var namef = $("#name");
        var email = $('input[name=email]').val();
        var emailf = $("#email");
        var message = $('textarea[name=message]').val();
        var messagef = $("#message");
        
        if(name == '' || email == '' || message == ''){
            alert("Deve preencher todos os campos!");
            return false;
        }
        
        post_data = {
            'name': name,
            'email': email,
            'message': message
        };

        $.ajax({
            type: 'post',
            url: 'includes/mailform.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert(response.text);
                }else{
                    successdiv.slideDown();
                    success.html(response.text);
                    namef.val("");
                    emailf.val("");
                    messagef.val("");
                }
            }
        });
        
    });
    
});