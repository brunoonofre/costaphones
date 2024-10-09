<?php 

    $id = filter_input(INPUT_POST, 'id_prod', FILTER_DEFAULT);

    $produto = $mysqli->query("SELECT * FROM produtos WHERE id_produto = $id");
    if($produto->num_rows == 0){
        header("Location: phones");
        exit;
    }
    $rowproduto= $produto->fetch_array();
    
    $promocao = $mysqli->query("SELECT * FROM discount WHERE id_produto = $id");
    if($promocao->num_rows==0){
        $prom = 0;
    }else{
        $prom = 1;
    }
    
    $rowpromocao = $promocao->fetch_array();
    
    
    $id_produto = $rowproduto['id_produto'];
    $nome = $rowproduto['nome'];
    $cores = json_decode($rowproduto['cores']);
    $fotocores = $rowproduto['fotocores'];
    $descricao = $rowproduto['descricao'];
    $preco = $rowproduto['preco'];
    $imagem = $rowproduto['imagem'];
    $stock = $rowproduto['stock'];
        
?>
<script type="text/JavaScript" src="js/cart_add.js"></script>
<script>
$(function(){
    
    $("input[type=radio]").on("change", function(){
        
        var idfoto = this.id;
        var fotocores = JSON.parse('<?php echo $fotocores?>');
        $("#prodviewfoto").attr("src", "img/phones/"+fotocores[idfoto]);
            
    });
    
    $("select#stock").on("change", function(){
        
        var id = $('input[name=id_prod]').val();
        var stock = $('select[name=stock]').val();

        post_data = {
            'id': id,
            'stock': stock
        };

        $.ajax({
            type: 'post',
            url: 'includes/edit_stock.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert("Ocorreu um erro inesperado!")
                }
            }
        });

    });
    
    $("#editbtn").click(function(){
           
            var prodid = $('input[name=id_prod]').val();
           
            var url = 'index.php?pag=editprod';
            var form = $('<form action="' + url + '" method="post"><input type="text" name="prodid" value="' + prodid + '" /></form>');
            $('body').append(form);
            form.submit();
    
    });
   
   $("#deletebtn").click(function(){

        if(!confirm("Tem a certeza que prentede eliminar este produto?")){
            return false;
        }

        var id = $('input[name=id_prod]').val();

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
                    location = 'phones';
                }
            }
        });

    });

});

</script>
<section id="prod">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-3">
                <img id="prodviewfoto" class="card-img-top" src="img/phones/<?php echo $imagem; ?>" alt="<?php echo $nome; ?>" data-holder-rendered="true" style="display: block; padding: 10px">
            </div>
            <div class="col-md-6">
                <h2 class="titulo marginbottom"><?php echo $nome; ?></h2>
                <h3 class="texto" style="color: green; font-size: 17px"><span class="fa fa-clipboard-check"></span> Top Quality Product</h3>
                <p class="cptexto marginbottom"><?php echo nl2br($descricao); ?></p>
            </div>
            <div class="col-md-3">
                
                <!-- Shipping Modal -->
                <a data-toggle="modal" data-target="#shippingTerms">
                  <p class="cptexto textterms" style="font-size:20px; cursor: pointer;"><span class="fa fa-shipping-fast"></span> Free Shipping</p>
                </a>
                <div class="modal fade" id="shippingTerms" tabindex="-1" role="dialog" aria-labelledby="shippingTermsTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title titulo" id="shippingTermsTitle">Shipping Terms</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <p class="cptexto marginbottom" style="font-size: 18px;">
                                All the products in our stock will take between 1-5 business days to arrive.<br>
                                The shipping is processed after we confirm the receipt of your payment.
                            </p>
                      </div>
                      <div class="modal-footer">
                        <button onclick="location='contact'" class="btn-lg btn-primary btncp btncpsmall" style="margin-top:0px;margin-bottom:0px" data-dismiss="modal">Contact Us</button>
                        <button class="btn-lg btn-secondary btncp btncpsmall" data-dismiss="modal" style="margin-top:0px;margin-bottom:0px;background-image:none">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Shipping Modal -->
                <a data-toggle="modal" data-target="#warrantyTerms">
                  <p class="cptexto textterms" style="font-size:20px; cursor: pointer;"><span class="fa fa-heart"></span> One-year Warranty</p>
                </a>
                <div class="modal fade" id="warrantyTerms" tabindex="-1" role="dialog" aria-labelledby="warrantyTermsTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title titulo" id="warrantyTermsTitle">Warranty Terms</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                           <p class="cptexto marginbottom" style="font-size: 18px;">
                              All the phones come with a one year warranty, beggining on the day of purchase.<br>
                              The battary warranty is only six months<br><br>
                              Warning!<br>
                              The warranty does not cover phones damaged by improper use. 
                            </p>
                      </div>
                      <div class="modal-footer">
                        <button onclick="location='contact'" class="btn-lg btn-primary btncp btncpsmall" style="margin-top:0px;margin-bottom:0px" data-dismiss="modal">Contact Us</button>
                        <button class="btn-lg btn-secondary btncp btncpsmall" data-dismiss="modal" style="margin-top:0px;margin-bottom:0px;background-image:none">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Shipping Modal -->
                <a data-toggle="modal" data-target="#returnPolicy">
                    <p class="cptexto textterms" style="font-size:20px; cursor: pointer;"><span class="fa fa-people-carry"></span> Return & Refund policy</p>
                </a>
                <div class="modal fade" id="returnPolicy" tabindex="-1" role="dialog" aria-labelledby="returnPolicyTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title titulo" id="returnPolicyTitle">Return & Refund Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                           <p class="cptexto marginbottom" style="font-size: 18px;">
                              In accordance with the legislation in force, if the client is not 100% satisfied with the product, he has 14 days, since the delivery day, to replace or refund the equipment, with the collect and shipping at our charge.<br><br>

                              The reffund is accepted if:<br>
                              - the equipment is rigorously equally as it was dispatched, follow by the billing document, with no signs of use;<br>
                              - all the components and accessories are in perfect condictions;<br>
                              Otherwise you will lose the right to replace or refund the product
                            </p>
                      </div>
                      <div class="modal-footer">
                        <button onclick="location='contact'" class="btn-lg btn-primary btncp btncpsmall" style="margin-top:0px;margin-bottom:0px" data-dismiss="modal">Contact Us</button>
                        <button class="btn-lg btn-secondary btncp btncpsmall" data-dismiss="modal" style="margin-top:0px;margin-bottom:0px;background-image:none">Close</button>
                      </div>
                    </div>
                  </div>
                </div><?php if($cat >= 1){ ?>
                <button class="btn-lg btn-primary btncp btncpsmal" data-toggle="modal" data-target="#promocao" style="float:none; margin: 0;">Promoção</button>
                <div class="modal fade" id="promocao" style="margin-top:130px;">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Promoção</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if($prom == 0){ ?>
                                <div class="form-group">
                                    <input type="number" class="form-control inputcp" min="0" step="0.01" name="preco" id="preco" placeholder="Preço em Euros" />
                                </div>
                                <button class="btn-lg btn-primary btncp btncpsmal" id="addprombtn">Guardar</button>
                                <script>
                                    $(function(){
    
                                        $("#addprombtn").click(function(){
                                            
                                            if ($('input[name=preco]').val() == ""){
                                                alert("Deve preencher todos os campos!");
                                                return false;
                                            }else{
                                                
                                                var id_prod = <?php echo $id?>;
                                                var preco = $('input[name=preco]').val();

                                                post_data = {
                                                    'id_prod': id_prod,
                                                    'preco': preco
                                                };

                                                $.ajax({
                                                    type: 'post',
                                                    url: 'includes/add_discount.php',
                                                    data: post_data,
                                                    dataType: 'json',
                                                    error: function(xhr, ajaxOptions, thrownError){
                                                        alert("Error:\n" + thrownError);
                                                    },
                                                    success: function(response){
                                                        if(response.success == false){
                                                            alert(response.text);
                                                        }else{
                                                            location.reload();
                                                        }
                                                    }
                                                });
                                            }


                                        });
                                        
                                    });
                                </script>
                                <?php }else{ ?>
                                <div class="form-group">
                                    <input type="number" class="form-control inputcp" min="0" step="0.01" name="preco" id="preco" value="<?php echo $rowpromocao['preco'];?>" />
                                </div>
                                <button class="btn-lg btn-primary btncp btncpsmal" id="delprombtn">Remover</button>
                                <button class="btn-lg btn-primary btncp btncpsmal" id="editprombtn">Guardar</button>
                                <script>
                                    $(function(){
    
                                        $("#editprombtn").click(function(){

                                            if ($('input[name=preco]').val() == ""){
                                                alert("Deve preencher todos os campos!");
                                                return false;
                                            }else{
                                                
                                                var id_prod = <?php echo $id?>;
                                                var preco = $('input[name=preco]').val();

                                                post_data = {
                                                    'id_prod': id_prod,
                                                    'preco': preco
                                                };

                                                $.ajax({
                                                    type: 'post',
                                                    url: 'includes/edit_discount.php',
                                                    data: post_data,
                                                    dataType: 'json',
                                                    error: function(xhr, ajaxOptions, thrownError){
                                                        alert("Error:\n" + thrownError);
                                                    },
                                                    success: function(response){
                                                        if(response.success == false){
                                                            alert(response.text);
                                                        }else{
                                                            location.reload();
                                                        }
                                                    }
                                                });
                                            }


                                        });
                                        
                                        $("#delprombtn").click(function(){

                                            if(!confirm("Tem a certeza que prentede eliminar este produto?")){
                                                return false;
                                            }
                                            
                                            var id_prod = <?php echo $id?>;

                                            post_data = {
                                                'id_prod': id_prod
                                            };

                                            $.ajax({
                                                type: 'post',
                                                url: 'includes/del_discount.php',
                                                data: post_data,
                                                dataType: 'json',
                                                error: function(xhr, ajaxOptions, thrownError){
                                                    alert("Error:\n" + thrownError);
                                                },
                                                success: function(response){
                                                    if(response.success == false){
                                                        alert(response.text);
                                                    }else{
                                                        location.reload();
                                                    }
                                                }
                                            });

                                        });
                                        
                                    });
                                </script>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>
                <?php }?>
                <?php if($cat >= 1){ ?>
                <select class="custom-select inputcp" id="stock" name="stock">
                    <option value="0" <?php if($stock==0){echo 'selected';} ?>>Available</option>
                    <option value="1" <?php if($stock==1){echo 'selected';} ?>>Out of Stock</option>
                </select>
                <?php }else{
                    if($stock==0){
                        echo '<p class="texto" style="color: green; font-size: 17px"><span class="fa fa-check-circle"></span> Available</p>';
                    }elseif($stock==1){
                        echo '<p class="texto" style="color: red; font-size: 17px"><span class="fa fa-times-circle"></span> Out of Stock</p>';
                    } 
                } ?>
                <div class="form-group">
                    <input class="form-control inputcp qnt" type="number" name="quantidade" id="quantidade" value="1" min="1" max="99"/>
                </div>
                <?php
                    $count=0;
                    foreach($cores as $cor){
                        echo '<div style="height: 25px; width: 50px; background-color: '.$cor.'; float: left;"><input style="margin-left:20px" type="radio" name="cor" value="'.$cor.'" id="'.$count.'"></div>';
                        $count=$count+1;
                    }
                ?>
                <br><br>
                    <?php if($prom == 0){?>
                    <h3 style="position: absolute;" class="preco-phones"><?php echo $preco; ?>€</h3>
                    <?php }else{ ?>
                    <del><?php echo $preco; ?>€</del><br>
                    <h3 style="position: absolute;" class="preco-phones"><?php echo $rowpromocao['preco']?>€</h3>
                    <?php } ?>
                <br>
                <input type="hidden" name="id_prod" value="<?php echo $id_produto; ?>">
                <input type="hidden" name="id_user" value="<?php echo $userid; ?>">
                <?php if($log == "in"){?>
                <button id="addtocart" class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-cart-plus"></span> Add to Cart</button>
                <?php }else{?>
                <button onclick="location.href='login';" class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-cart-plus"></span> Add to Cart</button> 
                <?php };
                if($cat >= 1){ ?>
                <button id="editbtn" class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-edit"></span> Edit</button>
                <button id="deletebtn" class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-eraser"></span> Delete</button>
                <?php }?>
            </div>
        </div>
    </div>
</div>