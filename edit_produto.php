<?php

    $prodid = filter_input(INPUT_POST, 'prodid', FILTER_SANITIZE_STRING);

    $sqlprod = $mysqli->query("SELECT * FROM produtos WHERE id_produto = $prodid");
    $rowprod = $sqlprod->fetch_array();

    
    $nome = $rowprod['nome'];
    $descricao = $rowprod['descricao'];
    $cores = json_decode($rowprod['cores']);
    $fotocores = json_decode($rowprod['fotocores']);
    $preco = $rowprod['preco'];
    $imagem = $rowprod['imagem'];
?>
<script type="text/JavaScript" src="js/edit_produto.js"></script>
<section id="addproduto">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-6 formcenter paddingbottom">
                <h2 class="titulo marginbottom">Editar Produto</h2>
                <div class="form-group">
                    <input type="text" class="form-control inputcp" placeholder="Nome" id="nome" name="nome" value="<?php echo $nome;?>" />
                </div>
                <div class="form-group">
                    <textarea style="resize: vertical; height: 100px;" class="form-control inputcp" name="descricao" id="descricao" placeholder="Descricao do Produto"><?php echo $descricao;?></textarea>
                </div>
                <div class="form-group">
                        <span id ="addcolor" class="fa fa-plus fa-lg delete"></span>
                        <div id="colors">
                            <?php
                                $count = 0;
                                foreach($cores as $cor){
                                    echo '<input type="color" class="nopadding" value="'.$cor.'"/>';
                                    echo '<input type="file" class="form-control inputcp" id="foto"/>';
                                    echo '<input type="hidden" value="'.$fotocores[$count].'"/>';
                                    $count = $count + 1;
                                }
                            ?>
                        </div>
                        <span id="delcolor" class="fa fa-minus fa-lg delete"></span>
                    </div>
                <div class="form-group">
                    <input type="number" class="form-control inputcp" min="0" step="0.01" name="preco" id="preco" placeholder="Preço em Euros" value="<?php echo $preco;?>" />
                </div>
                <div class="form-group">
                    <label style="text-align: left;">Fotografia</label><br>
                    <img style="height: 200px" src="img/phones/<?php echo $imagem;?>">
                    <input type="file" class="form-control inputcp" name="foto" id="foto" placeholder="<?php echo $imagem;?>"/>
                    <input type="hidden" name="foto2" value="<?php echo $imagem;?>">
                </div>
                <div id="errordiv" class="alert alert-danger">
                    <strong id="error"></strong>
                </div>
                <div id="successdiv" class="alert alert-success">
                    <strong id="success"></strong>
                </div>
                <input type="hidden" name="prodid" value="<?php echo $prodid ?>">
                <button id="btneditprod" class="btn-lg btn-primary btncp">Guardar</button>
            </div>
        </div>
    </div>
</section>