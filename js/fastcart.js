$(function(){

	var addcart = $(".fastcart");

	addcart.click(function(){
	    
	    var id_prod = this.id;
	    var id_user = $("input[name=id_user]").val();
	    
	    post_data = {
	        'id_prod': id_prod,
	        'id_user': id_user,
	        'quantidade': 1
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