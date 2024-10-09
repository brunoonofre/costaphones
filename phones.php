<?php 
    
    $produto = $mysqli->query("SELECT * FROM produtos");

?>
<script>
	
	function prodView(id_prod){ 
	    var url = 'phoneview';
	    var form = $('<form action="' + url + '" method="post"><input type="hidden" name="id_prod" value="' + id_prod + '" /></form>');
	    $('body').append(form);
	    form.submit();
	};

	$(function(){
    
	    $("span.edit").click(function(){
	           
	            var prodid = this.id;
	           
	            var url = 'editprod';
	            var form = $('<form action="' + url + '" method="post"><input type="hidden" name="prodid" value="' + prodid + '" /></form>');
	            $('body').append(form);
	            form.submit();
	    
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
	            url: 'includes/del_prod.php',
	            data: post_data,
	            dataType: 'json',
	            error: function(xhr, ajaxOptions, thrownError){
	                alert("Error:\n" + thrownError);
	            },
	            success: function(response){
	                if(response.success == false){
	                    alert("Ocorreu um erro inesperado!")
	                }else{
	                    $("#"+id).parent().parent().parent().slideUp();
	                }
	            }
	        });

	    });

	});

</script>
<script type="text/JavaScript" src="js/fastcart.js"></script>
<div class="container paddingtop">
    <div class="row">
        <div class="col-lg-1" style="margin-top: 105px;">
            <p class="cptexto">Todos</p>
            <p class="cptexto">iPhone 5</p>
            <p class="cptexto">iPhone 6</p>
            <p class="cptexto">iPhone 7</p>
            <p class="cptexto">iPhone 8</p>
            <p class="cptexto">iPhone X</p>
        </div>
        <div class="col-lg-11">
            <h2 class="titulo">Phones</h2>
            <?php if($cat >= 1){ ?>
            <a href='addprod' class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-plus"></span> Add Phone</a>
            <?php }?>
            <input type="hidden" name="id_user" value="<?php echo $userid; ?>">
            <div class="row paddingtop">
            <?php
                while($rowproduto= $produto->fetch_array()){
                        $id_produto = $rowproduto['id_produto'];
                        $nome = $rowproduto['nome'];
                        $descricao = $rowproduto['descricao'];
                        $preco = $rowproduto['preco'];
                        $imagem = $rowproduto['imagem'];
                        $stock = $rowproduto['stock'];
                
                        $promocao = $mysqli->query("SELECT * FROM discount WHERE id_produto = $id_produto");
                        if($promocao->num_rows==0){
                            $prom = 0;
                        }else{
                            $prom = 1;
                        }

                        $rowpromocao = $promocao->fetch_array();
            ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
              <div class="card mb-2 shadow-sm">
                <a style="height: 200px;" href="#" onClick="prodView('<?php echo $id_produto; ?>')">
                    <img class="card-img-top phoneimgpadding" alt="" src="img/phones/<?php echo $imagem; ?>" data-holder-rendered="true" style="height: 100%; object-fit: cover; display: block;">
                </a>
                <div class="card-phones" style="margin: 0px 15px; text-align: center">
                    <a class="nome-phones" href="#" onClick="prodView('<?php echo $id_produto; ?>')">
                        <h5 class="nome-phones">
                            <?php if($stock == 1){
                                echo '<span style="color: red;" class="fa fa-times-circle"></span> ';
                            }elseif($stock == 0){
                                echo '<span style="color: green;" class="fa fa-check-circle"></span> ';
                            }?>
                            <?php echo $nome; ?>
                        </h5>
                    </a>
                    <?php if($prom == 0){?>
                    <p class="preco-phones"><?php echo $preco; ?>€</p>
                    <?php }else{ ?>
                    <del>€<?php echo $preco; ?></del>
                    <p class="preco-phones"><?php echo $rowpromocao['preco']?>€</p>
                    <?php } ?>
                  <div class="d-flex justify-content-between align-items-center paddingbottom">
                    <?php if($log == "in"){?>
                    <span id="<?php echo $id_produto; ?>"  class="fa-stack fa-1x pointer">
                        <span id="bg<?php echo $id_produto; ?>"  class="fas fa-circle fa-stack-2x cpgradient"></span>
                        <span id="<?php echo $id_produto; ?>"  class="fas fa-cart-plus fa-stack-1x fa-inverse fastcart btnphones"></span>
                    </span>
                    <?php }; ?>
                    <?php if($cat >= 1){?>
                    <span id="<?php echo $id_produto; ?>"  class="fa-stack fa-1x pointer">
                        <span id="bg<?php echo $id_produto; ?>"  class="fas fa-circle fa-stack-2x cpgradient"></span>
                        <span id="<?php echo $id_produto; ?>"  class="fas fa-edit fa-stack-1x fa-inverse edit btnphones"></span>
                    </span>
                    <span id="<?php echo $id_produto; ?>" class="fa-stack fa-1x pointer">
                        <span id="bg<?php echo $id_produto; ?>" class="fas fa-circle fa-stack-2x cpgradient"></span>
                        <span id="<?php echo $id_produto; ?>" class="fas fa-trash fa-stack-1x fa-inverse delete btnphones"></span>
                    </span>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <script>
                $("span.btnphones").hover(
                    function() {
                        $(this).prev().css("-webkit-text-fill-color", "#343A40" );
                    }, function() {
                        $(this).prev().css("-webkit-text-fill-color", "transparent" );
                    }
                );
            </script>
            </div>
        </div>
    </div>
</div>