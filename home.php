<?php

    $promocoes = $mysqli->query("SELECT * FROM discount");

?>
<script>
    function prodView(id_prod){ 
        var url = 'phoneview';
        var form = $('<form action="' + url + '" method="post"><input type="hidden" name="id_prod" value="' + id_prod + '" /></form>');
        $('body').append(form);
        form.submit();
    };
</script>
<div class="container margintop">
    <div class="row">
      <div class="col-lg-12">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img  class="d-block" width="100%" src="img/slider/slide1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block" width="100%" src="img/slider/slide2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block" width="100%" src="img/slider/slide3.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
    <h4 class="titulo margintop marginbottom">Promoções</h4>
    <div class="row marginbottom">
        <?php 
            while($rowpromocoes= $promocoes->fetch_array()){
                $id_prod = $rowpromocoes['id_produto'];
                $produto = $mysqli->query("SELECT * FROM produtos WHERE id_produto = $id_prod");
                $rowproduto = $produto->fetch_array();
                $nome = $rowproduto['nome'];
                $preco = $rowproduto['preco'];
                $imagem = $rowproduto['imagem'];
                $stock = $rowproduto['stock'];

        ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
            <div class="card mb-2 shadow-sm">
              <a style="height: 320px;" href="#" onclick="prodView('<?php echo $id_prod; ?>')">
                  <img class="card-img-top phoneimgpadding" alt="" src="img/phones/<?php echo $imagem; ?>" data-holder-rendered="true" style="height: 100%; object-fit: cover; display: block;">
              </a>
              <div class="card-phones" style="margin: 0px 15px; text-align: center">
                  <a class="nome-phones" href="#" onclick="prodView('<?php echo $id_prod; ?>')">
                      <h5 class="nome-phones">
                          <?php if($stock == 1){
                                echo '<span style="color: red;" class="fa fa-times-circle"></span> ';
                            }elseif($stock == 0){
                                echo '<span style="color: green;" class="fa fa-check-circle"></span> ';
                            }?> <?php echo $nome; ?></h5>
                  </a>
                  <br>
                <del>€<?php echo $preco; ?></del>
                <p class="preco-phones"><?php echo $rowpromocoes['preco']?>€</p>
              </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<!-- /.container -->