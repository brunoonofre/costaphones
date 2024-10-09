$(function(){
    
    var errordiv = $("#errordiv");
    var errormsg = $("#error");
    var usernamesel = $("#username");
    var emailsel = $("#email");
    var namesel = $("#name");
    var passwordsel = $("#password");
    var confirmpwdsel = $("#confirmpwd");
    var button = $(".registar");
    var userreg = /^\w+$/;
    var pwreg = /(?=.*\d)(?=.*[a-z]).{6,}/;
   
    errordiv.hide();
    
    button.click(function(){
        
        if (usernamesel.val() == "" || emailsel.val() == "" || namesel.val() == "" || passwordsel.val() == "" || confirmpwdsel.val() == ""){
            errordiv.slideDown();
            errormsg.html("Deve preencher todos os campos!");
            return false;
        }else if(!userreg.test(usernamesel.val())){
            errordiv.slideDown();
            errormsg.html("O username só pode conter letras numeros e underscores(_)!");
            return false;
        }else if(passwordsel.val().length < 6){
            errordiv.slideDown();
            errormsg.html("A palavra-passe deve ter pelo menos 6 digitos!");
            return false;
        } else if(!pwreg.test(passwordsel.val())){
            errordiv.slideDown();
            errormsg.html("A palavra-passe deve conter letras e numeros!");
            return false;
        }else if(passwordsel.val() !== confirmpwdsel.val()){
            errordiv.slideDown();
            errormsg.html("A palavra-passe e a confirmação devem ser iguais!");
            return false;
        }else{
            var username = $('input[name=username]').val();
            var email = $('input[name=email]').val();
            var name = $('input[name=name]').val();
            var password = $('input[name=password]').val();
            var estatuto = $('select[name=estatuto]').val();

            var p = hex_sha512(password);

            post_data = {
                'username': username,
                'email': email,
                'name': name,
                'p': p,
                'estatuto': estatuto
            };

            $.ajax({
                type: 'post',
                url: 'includes/add_user.php',
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
                        window.location = 'guser?success=Utilizador adicionado com sucesso!';
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