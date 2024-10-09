$(function(){

    var successdiv = $("#successdiv");
    var success = $("#success");
    var edit = $(".edit");

    successdiv.hide();
    edit.hide();

    $("span.edit").click(function(){

        var id = this.id;
        var quantidade = $('input[name=quantidade'+id+']').val();
        var cor = $('select[name=cor'+id+']').val();
        
        if(quantidade<=0){
           if(!confirm("Tem a certeza que prentede eliminar este produto?")){
                return false;
            }

            post_data = {
                'id': id
            };

            $.ajax({
                type: 'post',
                url: 'includes/del_cart.php',
                data: post_data,
                dataType: 'json',
                error: function(xhr, ajaxOptions, thrownError){
                    alert("Error:\n" + thrownError);
                },
                success: function(response){
                    if(response.success == false){
                        alert("Ocorreu um erro inesperado!")
                    }else{
                        $("#"+id).parent().parent().parent().remove();
                        var total = totalPreco();
                        $("#total").html(total);
                        $("#carttotal").html(total);
                    }
                }
            });
            return false;
        }

        post_data = {
            'id': id,
            'quantidade': quantidade,
            'cor': cor
        };

        $.ajax({
            type: 'post',
            url: 'includes/edit_cart.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert("Ocorreu um erro inesperado!")
                }else{
                    $("#"+id+".edit").hide();
                    var preco = parseFloat($("#preco"+id).text());
                    var totalprod = quantidade*preco;
                    $("#totalprod"+id).html(totalprod);
                    var total = totalPreco();
                    $("#total").html(total);
                    $("#carttotal").html(total);
                }
            }
        });

    });

    $("span.delete").click(function(){
        
        if(!confirm("Tem a certeza que prentede eliminar este produto?")){
            return false;
        }

        var id = this.id;

        post_data = {
            'id': id
        };

        $.ajax({
            type: 'post',
            url: 'includes/del_cart.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert("Ocorreu um erro inesperado!")
                }else{
                    $("#"+id).parent().parent().parent().remove();
                    var total = totalPreco();
                    $("#total").html(total);
                    $("#carttotal").html(total);
                }
            }
        });

    });

});