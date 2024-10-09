<?php 
    
    $id = filter_input(INPUT_POST, 'id_order', FILTER_DEFAULT);
    
    $orderview = $mysqli->query("SELECT * FROM orders WHERE id_order = $id");
    if($orderview->num_rows == 0){
        header("Location: orders");
        exit;
    }
    $roworderview= $orderview->fetch_array();
    
    
    $id_order = $roworderview['id_order'];
    $id_user = $roworderview['id_user'];
    $encomenda = (array) json_decode($roworderview['encomenda'], true);
    $street = $roworderview['street'];
    $city = $roworderview['city'];
    $country = $roworderview['country'];
    $state = $roworderview['state'];
    $zip = $roworderview['zip'];
    $phone = $roworderview['phone'];
    $preco = $roworderview['preco'];
    $shipcost = $roworderview['shipcost'];
    $estado = $roworderview['estado'];
    $data = $roworderview['data'];
    
    $rowuser = $mysqli->query("SELECT name, email FROM members WHERE id = $id_user");
    $user = $rowuser->fetch_array();
    $name = $user['name'];
    $email = $user['email'];
    
    $total = 0;
    
?>
<script>
$(function(){
   
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
            url: 'includes/del_order.php',
            data: post_data,
            dataType: 'json',
            error: function(xhr, ajaxOptions, thrownError){
                alert("Error:\n" + thrownError);
            },
            success: function(response){
                if(response.success == false){
                    alert("Ocorreu um erro inesperado!")
                }else{
                        location = 'orders';
                }
            }
        });

    });

});

</script>
<section id="orderview">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-12">
                <h2 class="titulo marginbottom">Order #<?php echo $id_order; ?></h2>
                <h3 class="texto"><?php echo $data; ?></h3>
                <strong><?php if($estado==0){
                                    echo 'Your order is being processed';
                                }elseif($estado==1){
                                    echo 'Your order has been shipped, wait patiently';
                                }elseif($estado==2){
                                    echo 'We are awaiting for your payment, we will process and ship your order as soon as we receive it.<br>IBAN: 0123 4567 8910 1112 1314 15';
                                } ?></strong>
                <p class="margintop"><?php echo $name; ?><br><br>
                    <?php echo $street; ?><br>
                    <?php echo $zip; ?> <?php echo $city;?><br>
                    <?php echo $state;?> <?php echo $country; ?><br>
                    <?php echo $phone; ?><br>
                    <?php echo $email; ?></p>
                <table class="table table-striped table-hover centertable margintop">
                    <tbody>
                        <?php 
                            foreach ($encomenda as $item) {
                                $nome = $item['nome'];
                                $quantidade = $item['quantidade'];
                                $cor = $item['cor'];
                                $precoit = $item['preco'];
                                $total_prod = $item['total_prod'];
                                $total = $total + $total_prod;
                        ?>
                        <tr style="background-color: white;">
                            <td class="tabelatexto"><?php echo $nome; ?></td>
                            <td class="tabelatexto" style="text-align: center;background-color: <?php echo $cor; ?>"></td>
                            <td class="tabelatexto" style="text-align: center;">€<span><?php echo $precoit.' x '.$quantidade; ?></span></td>
                            <td class="tabelatexto" style="text-align: center;">€<span class="totalprod"><?php echo $total_prod; ?></span>
                        </tr>
                        <?php }
                                $discount = $total - $preco; ?>
                        <tr>
                            <td style="background-color: #F2F2F2; border: 0"></td>
                            <td style="background-color: #F2F2F2; border: 0"></td>
                            <td class="tabelatitulo" style="background-color: #5C6166; text-align: center; color: white;">Shipping</td>
                            <td class="tabelatitulo" style="background-color: #5C6166; text-align: center; color: white; font-weight: 400">€<span id="total"><?php echo $shipcost; ?></span></td>
                        </tr>
                        <tr>
                            <td style="border: 0"></td>
                            <td style="border: 0"></td>
                            <td class="tabelatitulo" style="background-color: #5C6166; text-align: center; color: white;">Discount</td>
                            <td class="tabelatitulo" style="background-color: #5C6166; text-align: center; color: white; font-weight: 400">€<span id="total"><?php echo $discount; ?></span></td>
                        </tr>
                        <tr>
                            <td style="background-color: #F2F2F2; border: 0"></td>
                            <td style="background-color: #F2F2F2; border: 0"></td>
                            <td class="tabelatitulo" style="background-color: #343A40; text-align: center; color: white;">TOTAL</td>
                            <td class="tabelatitulo" style="background-color: #343A40; text-align: center; color: white; font-weight: 400">€<span id="total"><?php echo $preco+$shipcost; ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
