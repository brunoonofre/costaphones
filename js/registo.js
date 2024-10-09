$(function(){

    var errordiv = $("#errordiv");
    var error = $("#error");
    var nome = $("#nome");
    var user = $("#user");
    var email = $("#email");
    var pass = $("#password");
    var confirmpw = $("#confirmpw");
    var button = $(".registar");
    var userreg = /^\w+$/;
    var pwreg = /(?=.*\d)(?=.*[a-z]).{6,}/;
    
    errordiv.hide();   
    
    $("input").keypress(function(event){
        if(event.which==13){
            button.click();
        } 
        
    });
    
    button.click(function(){
        
        if(nome.val() == '' || user.val() == '' || email.val() == '' || pass.val() == '' || confirmpw.val() == ''){
            errordiv.slideDown();
            error.html("Deve preencher todos os campos!");
            return false;
        }else if(!userreg.test(user.val())){
            errordiv.slideDown();
            error.html("O username só pode conter letras, numeros e underscores(_)!");
            return false;
        }else if(pass.val().length < 6){
            errordiv.slideDown();
            error.html("A palavra-passe deve ter pelo menos 6 digitos!");
            return false;
        }else if(!pwreg.test(pass.val())){
            errordiv.slideDown();
            error.html("A palavra-passe deve conter letras e numeros!");
            return false;
        }else if(pass.val() != confirmpw.val()){
            errordiv.slideDown();
            error.html("A palavra-passe e a confirmação devem ser iguais!");
            return false;
        }else{
            errordiv.slideUp();
            
            var inome = $("input[name=nome]").val();
            var iuser = $("input[name=user]").val();
            var iemail = $("input[name=email]").val();
            var ipass = $("input[name=password]").val();
            
            var p = hex_sha512(ipass);
            
            post_data = {
                'name': inome,
                'username': iuser,
                'email': iemail,
                'p': p
            };
            
            $.ajax({
                type: 'post',
                url: 'includes/register.php',
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
                        window.location = 'index.php?pag=login&nav=5&success=Registo efectuado com sucesso!';
                    }
                }
            });
        }
        
    });
});