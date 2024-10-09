$(function(){

    var successdiv = $("#successdiv");
    var success = $("#success");
    var edit = $(".edit");

    successdiv.hide();
    edit.hide();

    $("span.edit").click(function(){

        var id = this.id;
        var shipcost = $('input[name=shipcost'+id+']').val();

        post_data = {
            'id': id,
            'shipcost': shipcost
        };

        $.ajax({
            type: 'post',
            url: 'includes/edit_shipping.php',
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
                }
            }
        });

    });

    $("span.delete").click(function(){
          
        if(!confirm("Tem a certeza que prentede eliminar este pais do registo??")){
            return false;
        }

        var id = this.id;

        post_data = {
            'id': id
        };

        $.ajax({
            type: 'post',
            url: 'includes/del_shipping.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert("Ocorreu um erro inesperado!")
                }else{
                    $("#"+id).parent().parent().slideUp();
                }
            }
        });

    });

});