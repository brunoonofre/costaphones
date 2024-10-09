$(function(){
    
    var button = $("#addtocart");
    
    button.click(function(){
        
        var id_prod = $("input[name=id_prod]").val();
        var id_user = $("input[name=id_user]").val();
        var quantidade = $("input[name=quantidade]").val();
        var cor = $("input[name=cor]:checked").val();
        
        if(cor == null){
            alert("Choose the color you wish!");
            return false;
        }
        
        post_data = {
            'id_prod': id_prod,
            'id_user': id_user,
            'quantidade': quantidade,
            'cor': cor
        };

        $.ajax({
            type: 'post',
            url: 'includes/cart_add.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert(response.text);
                }else{
                    window.location = 'cart';
                }
            }
        });
        
    });
    
});