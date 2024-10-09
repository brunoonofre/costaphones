<?php 
    $sql = $mysqli->query("SELECT c.id_cart as id_cart,  
        c.id_produto as id_produto,
        p.nome as nome, 
        c.quantidade as quantidade,
        c.cor as cor,
        p.cores as cores,
        p.imagem as imagem,
        p.preco as preco, 
        p.preco*c.quantidade as total_prod 
        FROM cart c
        INNER JOIN produtos p
        ON c.id_produto=p.id_produto 
        WHERE c.id_user = $userid");

    $total = 0;
    if($sql->num_rows == 0){
        $cart = 'empty';
    }
?>
<script type="text/javascript">

    function totalPreco() {
        var preco = 0;
        $('span.totalprod').each(function () {
            var prodpreco = Number($(this).text());
            preco = preco + prodpreco;
        });
        return preco.toFixed(2);
    }
</script>
<script type="text/JavaScript" src="js/cart.js"></script>
<section id="cart">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-12 paddingbottom marginbottom">
                <h2 class="titulo marginbottom">Cart</h2>
                <?php if($cart == 'empty'){?>
                <h3 class="texto" style="margin-top: -15px; margin-bottom: -5px">Your cart is empty.</h3>
                <?php }else{?>
                <h3 class="texto" style="margin-top: -15px; margin-bottom: -5px">Please review your cart before confirming your order.</h3>
                <div id="successdiv" class="alert alert-success">
                    <strong id="success"></strong>
                </div>
                <table class="table table-striped table-hover centertable">
                    
                    <tbody>
                        <?php 
                            while($rowcart = $sql->fetch_array()){
                                $id_cart = $rowcart['id_cart'];
                                $id_produto = $rowcart['id_produto'];
                                $imagem = $rowcart['imagem'];
                                $nome = $rowcart['nome'];
                                $quantidade = $rowcart['quantidade'];
                                $cores = json_decode($rowcart['cores']);
                                $cor = $rowcart['cor'];
                                
                                
                                $promocao = $mysqli->query("SELECT * FROM discount WHERE id_produto = $id_produto");
                                if($promocao->num_rows==0){
                                    $preco = $rowcart['preco'];
                                    $total_prod = $preco * $quantidade;
                                    $total = $total + $total_prod;
                                }else{
                                    $rowpromocao = $promocao->fetch_array();
                                    $preco = $rowpromocao['preco'];
                                    $total_prod = $preco * $quantidade;
                                    $total = $total + $total_prod;
                                }
                        ?>
                        <tr style="background-color: white;">
                            <td><img width="100px" src="img/phones/<?php echo $imagem; ?>" /></td>
                            <td class="tabelatexto"><?php echo $nome; ?></td>
                            <td class="tabelatexto" style="text-align: center;">€<span id="preco<?php echo $id_cart; ?>"><?php echo $preco; ?></span></td>
                            <td class="tabelatexto"><div form-control>
                                <input class="form-control inputcp qnt" id="<?php echo $id_cart; ?>" type="number" name="quantidade<?php echo $id_cart; ?>" value="<?php echo $quantidade ?>"/>
                                </div>
                            </td>
                            <td id="cores<?php echo $id_cart; ?>">
                                <select style="background: <?php echo $cor?>" class="form-control" name="cor<?php echo $id_cart; ?>" id="<?php echo $id_cart; ?>">
                                        <?php
                                            foreach($cores as $c){
                                                if($c == $cor){
                                                    echo '<option value=',$c,' style="background-color:',$c,'" selected></option>';
                                                }else{
                                                    echo '<option value=',$c,' style="background-color:',$c,'"></option>';
                                                }
                                            }
                                        ?>
                                </select></td>
                            <td class="tabelatexto" style="text-align: center;">€<span class="totalprod" id="totalprod<?php echo $id_cart; ?>"><?php echo $total_prod; ?></span></td>
                            <td class="tabelatexto">
                                <span style="cursor: pointer;"
                                      id="<?php echo $id_cart; ?>" 
                                      class="fa fa-lg fa-check edit"> 
                            </td>
                            <td class="tabelatexto">
                                <span style="cursor: pointer;"
                                      id="<?php echo $id_cart; ?>" 
                                      class="fa fa-lg fa-trash delete"></span>
                            </td>
                        </tr>
                        <?php } ?>
                        
                                <script>
                                        $("select[name*=cor]").on('change',function(){
                                            var id = this.id;
                                            var cor = $(this).val();
                                            $(this).css("background", cor);
                                            $("#"+id+".edit").show();
                                        });
                                        
                                        $("input[name*=quantidade]").on('change keyup',function(){
                                            var id = this.id;
                                            $("#"+id+".edit").show();
                                        });
                                </script>
                        <tr>
                            <td style="background-color: #F2F2F2"></td>
                            <td style="background-color: #F2F2F2"></td>
                            <td style="background-color: #F2F2F2"></td>
                            <td style="background-color: #F2F2F2"></td>
                            <td class="tabelatitulo" style="background-color: #343A40; text-align: center; color: white;">TOTAL</td>
                            <td class="tabelatitulo" style="background-color: #343A40; text-align: center; color: white; font-weight: 400">€<span id="total"><?php echo $total; ?></span></td>
                            <td style="background-color: #F2F2F2"></td>
                            <td style="background-color: #F2F2F2"></td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center;">
                    <button class="btn-lg btn-primary btncp btncpsmall" onclick="location.href='order';"><span class="fa fa-shopping-cart"></span> Finish Order</button>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>