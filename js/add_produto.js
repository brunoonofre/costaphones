$(function(){
   
    var errordiv = $("#errordiv");
    var error = $("#error");
    var successdiv = $("#successdiv");
    var success = $("#success");
    var nomef = $("#nome");
    var descricaof = $("#descricao");
    var precof = $("#preco");
    var fotof = $("#foto");
    var button = $("#btnaddprod");
    var icolors = $("#colors");
    var addcolor = $("#addcolor");
    var delcolor = $("#delcolor");
    
    errordiv.hide();
    successdiv.hide();
    
    $("input").keypress(function(event){
        if(event.which==13){
            button.click();
        } 
        
    });
    
    addcolor.click(function(){
        icolors.append('<input type="color" class ="nopadding" value="#ffffff"/>');
        icolors.append('<input type="file" class="form-control inputcp" id="foto" placeholder="Fotografia da cor" />');
    });
    
    delcolor.click(function(){
        $("#colors input:last").fadeOut(function(){
            $("#colors input:last").remove();$("#colors input:last").remove();
        });
    });

    //Image upload
    $("input[type=file]").change(function(){

        errordiv.slideUp();
        successdiv.slideUp();

        //verify File API
        if(!window.File || !window.FileReader){
            errordiv.slideDown();
            error.html("Erro no upload! O seu browser não suporta a API de Ficheiros!");
            return;
        }

        //create new file reader
        var fileReader = new FileReader();

        //create filter regexp
        var filter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

        //verify file was uploaded
        if(this.files.length == 0){
            errordiv.slideDown();
            error.html("Selecione uma imagem!");
            return;
        }

        var file = this.files[0];
        var size = file.size;
        var type = file.type;

        //verify file type is an image
        if (!filter.test(type)) {
            errordiv.slideDown();
            error.html("Tipo de ficheiro não suportado!");
            return;
        }

        var max = 2000000;

        //verify if file larger than 2mb
        if (size > max) {
            errordiv.slideDown();
            error.html("Insira uma imagem com menos de 2MB");
            return;
        }
        
        //create new instance of FormData
        var formData = new FormData();
        formData.append('image_data', file);
       
        successdiv.slideDown();
        success.html("<i class='fa fa-circle-o-notch fa-spin'></i> Espere que o upload termine antes de submeter!");
        //upload
        $.ajax({
           type: 'POST',
           processData: false,
           contentType: false,
           url: 'includes/image_upload.php',
           data: formData,
           dataType: 'json',
           success: function(response){
               if(response.success == 'true'){
                   errordiv.slideUp();
                   successdiv.slideDown();
                   success.html(response.text);
               }else{
                   successdiv.slideUp();
                   errordiv.slideDown();
                   error.html(response.text);
               }
           }
        });
    });
    
    
    button.click(function(){
        
        
        if(nomef.val() == '' ||descricaof.val() == '' || precof.val() == '' || fotof.val() == ''){
            successdiv.slideUp();
            errordiv.slideDown();
            error.html("Deve preencher todos os campos!");
            return false;
        }else{
            
            var colors = new Array();
            var colorfoto = new Array();
            
            $('#colors input[type=color]').each(function(){
                colors.push($(this).val());
            });
            $('#colors input[type=file]').each(function(){
                colorfoto.push($(this).val().replace(/C:\\fakepath\\/i, ''));
            });

            var nome = $('input[name=nome]').val();
            var descricao = $('textarea[name=descricao]').val();
            var cores = JSON.stringify(colors);
            var fotocores = JSON.stringify(colorfoto);
            var preco = $('input[name=preco]').val();
            var foto = $('input[name=foto]').val().replace(/C:\\fakepath\\/i, '');
            
            
            post_data = {
                'nome': nome,
                'descricao': descricao,
                'cores': cores,
                'fotocores': fotocores,
                'preco': preco,
                'foto': foto
            };

            $.ajax({
                type: 'post',
                url: 'includes/add_produto.php',
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
                        successdiv.slideDown();
                        success.html(response.text);
                        location = 'phones';
                    }
                }
            });
            
        }
        
    });
    
});