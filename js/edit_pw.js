$(function(){
   
    var successdiv = $("#successdiv");
    var errordiv = $("#errordiv");
    var success = $("#success");
    var error = $("#error");
    var button = $("#edituserbtn");
    
    successdiv.hide();
    errordiv.hide();
    
    $(".form-group").keypress(function(event){
        if(event.which==13){
            button.click();//button
        } 
        
    });
    
    button.click(function(){
        
        var oldpassword = $("input[name=oldpassword]").val();
        var password = $("input[name=password]").val();
        var confirmpwd = $("input[name=confirmpwd]").val();
        var pwreg = /(?=.*\d)(?=.*[a-z]).{6,}/;
        
        if(oldpassword == "" || password == "" || confirmpwd == ""){
            errordiv.slideDown();
            error.html("Deve preencher todos os campos!");
            return false;
        }else if(password.length < 6){
            errordiv.slideDown();
            error.html("A palavra-passe deve ter pelo menos 6 digitos!");
            return false;
        }else if(!pwreg.test(password)){
            errordiv.slideDown();
            error.html("A palavra-passe deve ser conter caracteres numericos!");
            return false;
        }else if(password != confirmpwd){
            errordiv.slideDown();
            error.html("A palavra-passe e a confirmação devem ser iguais!");
            return false;
        }
               
        errordiv.slideUp();
        var oldp = hex_sha512(oldpassword);
        var p = hex_sha512(password);
        
//        alert("teste");
//        return false;
        
        post_data = {
            'oldp': oldp,
            'p': p
        };
        
        $.ajax({
            type: 'post',
            url: 'includes/edit_pw.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){                
                    errordiv.slideDown();
                    error.html(response.text);
                }else{
                    window.location = 'user?success=Palavra-passe alterada com sucesso!';
                }
            }
        });
        
        
       
    });
    
});