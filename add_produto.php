<script type="text/JavaScript" src="js/add_produto.js"></script>
<section id="addproduto">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-6 formcenter marginbottom paddingbottom">
                <h2 class="titulo marginbottom">Adicionar Produto</h2>
                <div class="form-group">
                    <input type="text" class="form-control inputcp" placeholder="Nome" id="nome" name="nome" />
                </div>
                <div class="form-group">
                    <textarea style="resize: vertical; height: 100px;" class="form-control inputcp" name="descricao" id="descricao" placeholder="Descricao do Produto"></textarea>
                </div>
                <div class="form-group">
                        <span id ="addcolor" class="fa fa-plus fa-lg delete"></span>
                        <div id="colors">
                            <input type="color" class ="nopadding" value=""/>
                            <input type="file" class="form-control inputcp" id="foto" placeholder="Fotografia da cor" />
                        </div>
                        <span id="delcolor" class="fa fa-minus fa-lg delete"></span>
                    </div>
                <div class="form-group">
                    <input type="number" class="form-control inputcp" min="0" step="0.01" name="preco" id="preco" placeholder="Preço em Euros" />
                </div>
                <div class="form-group">
                    <label style="text-align: left;">Fotografia</label>
                    <input type="file" class="form-control inputcp" name="foto" id="foto" placeholder="Fotografia" />
                </div>
                <div id="errordiv" class="alert alert-danger">
                    <strong id="error"></strong>
                </div>
                <div id="successdiv" class="alert alert-success">
                    <strong id="success"></strong>
                </div>
                <button id="btnaddprod" class="btn-lg btn-primary btncp">Guardar</button>
            </div>
        </div>
    </div>
</section>