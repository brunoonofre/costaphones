$(function(){
   
    var button = $("#edituserbtn");
    var successdiv = $("#successdiv");
    var errordiv = $("#errordiv");
    var errormsg = $("#error");
    var successmsg = $("#success");
    
    successdiv.hide();
    errordiv.hide();
    
    $(".form-group").keypress(function(event){
        if(event.which==13){
            button.click();//button
        } 
        
    });
    
    button.click(function(){
        
        var username = $("input[name=username]").val();
        var email = $("input[name=email]").val();
        var name = $("input[name=name]").val();
        var userid = $("input[name=userid]").val();
        var redirpage = $("input[name=redirpage]").val();
        var estatuto = $("select[name=estatuto]").val();
        var usernamereg = /^\w+$/;
       
        if (username == "" || email == "" || name == ""){
            errordiv.slideDown();
            errormsg.html("Deve preencher todos os campos!");
            return false;
        }else if(!usernamereg.test(username)){
            errordiv.slideDown();
            errormsg.html("O username só pode conter letras numeros e underscores(_)!");
            return false;
        }else{
            errordiv.slideUp();

            post_data = {
                'username': username,
                'email': email,
                'name': name,
                'userid': userid,
                'estatuto': estatuto
            };
            
            $.ajax({
                type: 'post',
                url: 'includes/edit_user.php',
                data: post_data,
                dataType: 'json',
                error: function(xhr, ajaxOptions, thrownError){
                    alert("Error: " + thrownError);
                },
                success: function(response){
                    if(response.success == false){
                        successdiv.slideUp();
                        errordiv.slideDown();
                        errormsg.html(response.text);
                    }else{
                        errordiv.slideUp();
                        window.location = redirpage + '?success=Dados actualizados com sucesso!';
                    }
                }
            });
        }
        
    });
    
});