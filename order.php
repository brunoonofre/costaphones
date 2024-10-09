<?php 

    $encomenda = array();

	$order = $mysqli->query("SELECT c.id_cart as id_cart,  
        c.id_produto as id_produto,
        p.nome as nome, 
        c.quantidade as quantidade, 
        c.cor as cor,
        p.preco as preco, 
        p.preco*c.quantidade as total_prod 
        FROM cart c
        INNER JOIN produtos p
        ON c.id_produto=p.id_produto 
        WHERE c.id_user = $userid");
        
        if($order->num_rows == 0){
            header("Location: cart");
            exit;
        }
        
        $address = $mysqli->query("SELECT a.id_address as id_address,
        a.street as street,
        a.city as city,
        a.state as state,
        s.country as country,
        a.zip as zip,
        a.phone as phone,
        s.shipcost as shipcost
        FROM addresses a
        INNER JOIN shipping s
        ON s.id_shipping=a.country 
        WHERE a.id_user = $userid");

        $sqlprodcount = $mysqli->query("SELECT SUM(quantidade) as quantidade FROM cart WHERE id_user = $userid");
        
        
        $rowaddress = $address->fetch_array();
        
        $id_address = $rowaddress['id_address'];
        $street = $rowaddress['street'];
        $city = $rowaddress['city'];
        $state = $rowaddress['state'];
        $country = $rowaddress['country'];
        $zip = $rowaddress['zip'];
        $phone = $rowaddress['phone'];
        $shipcost = $rowaddress['shipcost'];

        $rowprodcount = $sqlprodcount->fetch_array();

        $prodcount = $rowprodcount['quantidade'];

	$total = 0;
	$prodnum = 0;
	
?>

<script type="text/JavaScript" src="js/order.js"></script>
<div class="container paddingtop">
<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="titulo marginbottom">Your cart</span>
        <span class="badge badge-secondary badge-pill"><?php echo $prodcount ?></span>
      </h4>
      <ul class="list-group mb-3">
          <?php 
                while($roworder = $order->fetch_array()){
                    $id_cart = $roworder['id_cart'];
                    $id_produto = $roworder['id_produto'];
                    $nome = $roworder['nome'];
                    $quantidade = $roworder['quantidade'];
                    $cor = $roworder['cor'];
                    
                    $promocao = $mysqli->query("SELECT * FROM discount WHERE id_produto = $id_produto");
                    if($promocao->num_rows==0){
                        $preco = $roworder['preco'];
                        $total_prod = $preco * $quantidade;
                        $total = $total + $total_prod;
                    }else{
                        $rowpromocao = $promocao->fetch_array();
                        $preco = $rowpromocao['preco'];
                        $total_prod = $preco * $quantidade;
                        $total = $total + $total_prod;
                    }
                    
                    $prodnum = $prodnum + $quantidade;
                    
                    array_push($encomenda, $roworder);

                
            ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo $nome;?></h6>
            <small class="text-muted">€<?php echo $preco;?> x <?php echo $quantidade;?></small>
          </div>
          <span class="text-muted">€<?php echo $total_prod;?></span>
        </li>
        <?php }?>
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div>
            <span>Shipping</span>
          </div>
          <span class="text-muted">€<span id='shipcost'><?php echo $shipcost;?></span></span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (EUR)</span>
          <strong>€<span id='total'><?php echo $total+$shipcost;?></span></strong>
        </li>
      </ul>
        <?php $orderarr = json_encode($encomenda);?>
        <div id="paypal-button"></div>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script>
          paypal.Button.render({
            // Configure environment
            env: 'production',
            client: {
              production: 'Aby_aZCziItQ_8N0Qm9BREpFwF9P1-vvsV4VR2KjtloWSOlqy1yb92yxyGP-2EgG4OAR9zliLkQKFPub'
            },
            // Customize button (optional)
            locale: 'pt_PT',
            style: {
              size: 'responsive',
              color: 'black',
              shape: 'rect'
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                var country = JSON.parse($('select[name=country]').val());
                return actions.payment.create({
                    intent: 'sale',
                    transactions: [{
                        amount: {
                          total: <?php echo $total;?>+country.shipcost,
                          currency: 'EUR'
                    }
                  }],
                  note_to_payer: 'Contact us for any questions on your order.'
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
              return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                var country = JSON.parse($('select[name=country]').val());
                var userid = <?php echo $userid?>;
                var encomenda = '<?php echo $orderarr?>' ;
                var street = $('input[name=street]').val();
                var state = $('input[name=state]').val();
                var city = $('input[name=city]').val();
                var zip = $('input[name=zip]').val();
                var phone = $('input[name=phone]').val();
                var preco = <?php echo $total?>;
                
                post_data = {
                    'userid': userid,
                    'encomenda': encomenda,
                    'street': street,
                    'city': city,
                    'state': state,
                    'country': country.country,
                    'zip': zip,
                    'phone': phone,
                    'preco': preco,
                    'shipcost': country.shipcost,
                    'estado': 0
                };

                $.ajax({
                    type: 'post',
                    url: 'includes/order.php',
                    data: post_data,
                    dataType: 'json',
                    error: function(xhr, ajaxOptions, thrownError){
                        alert("Error:\n" + thrownError);
                    },
                    success: function(response){
                        if(response.success == false){
                            alert('Ocorreu um erro!');
                        }else{
                            location = 'orderlist';
                        }
                    }
                });
              });
            }
          }, '#paypal-button');

        </script>
        <hr class="mb-4">
        <button id="banktransfer" class="btn btn-dark" style="width: 100%">Pay by Bank Transfer</button>
        <p class="cptexto" style="text-align: center;">IBAN: PT50 0123 4567 8910 1112 1324 15</p>
        <script>
            $(function(){

                $("#banktransfer").click(function(){
                    var country = JSON.parse($('select[name=country]').val());
                    var userid = <?php echo $userid?>;
                    var encomenda = '<?php echo $orderarr?>' ;
                    var street = $('input[name=street]').val();
                    var state = $('input[name=state]').val();
                    var city = $('input[name=city]').val();
                    var zip = $('input[name=zip]').val();
                    var phone = $('input[name=phone]').val();
                    var preco = <?php echo $total?>;

                    post_data = {
                        'userid': userid,
                        'encomenda': encomenda,
                        'street': street,
                        'city': city,
                        'state': state,
                        'country': country.country,
                        'zip': zip,
                        'phone': phone,
                        'preco': preco,
                        'shipcost': country.shipcost,
                        'estado': 2
                    };

                    $.ajax({
                        type: 'post',
                        url: 'includes/order.php',
                        data: post_data,
                        dataType: 'json',
                        error: function(xhr, ajaxOptions, thrownError){
                            alert("Error:\n" + thrownError);
                        },
                        success: function(response){
                            if(response.success == false){
                                alert('Error occured! If the problem persists, contact us.');
                            }else{
                                location = 'orderlist';
                            }
                        }
                    });
                });

            });
        </script>
    </div>
    <div class="col-md-7 order-md-1">
      <h4 class="titulo marginbottom">Shipping address</h4>
        <div class="mb-3">
            <label for="street">Address</label>
            <input type="text" class="form-control inputcp" name="street" id="street" value="<?php echo $street;?>" required="">
          </div>
        <div class="row">
          <div class="col-md-8 mb-3">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control inputcp" name="phone" id="phone" value="<?php echo $phone;?>" required="">
          </div>
          <div class="col-md-4 mb-3">
            <label for="zip">Zip</label>
            <input type="tel" class="form-control inputcp" name="zip" id="zip" value="<?php echo $zip;?>" required="">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="city">City</label>
            <input type="text" class="form-control inputcp" name="city" id="city" value="<?php echo $city;?>" required="">
          </div>
            <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <input type="text" class="form-control inputcp" name="state" id="state" value="<?php echo $state;?>" required="">
          </div>
          <div class="col-md-4 mb-3">
            <label for="country">Country</label>
              <select class="custom-select d-block w-100 inputcp" name="country" id="country">
                    <option value='{"shipcost":<?php echo $shipcost ?>,"country":"<?php echo $country;?>"}' selected style='display:none;'><?php echo $country;?></option>
                    <?php  
                        $queryshipping = $mysqli->query("SELECT * FROM shipping ORDER BY country ASC");
                        while($rowshipping = $queryshipping->fetch_array()){ ?>
                    <option value='{"shipcost":<?php echo $rowshipping['shipcost'] ?>,"country":"<?php echo $rowshipping['country'] ?>"}'><?php echo ucfirst($rowshipping['country']); ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>
        <hr class="mb-4">
        <p class="cptexto marginbottom">If you wish to pay by bank transfer place your order and make the payment to the IBAN under the button at your right side.<br>
        We will process and ship your order as soon as we receive the payment!</p>
    </div>
    <script>
        $("#country").on('change',function(){
            var country = JSON.parse($('select[name=country]').val());
            $("#shipcost").html(country.shipcost);
            $("#total").html(country.shipcost+<?php echo $total?>);
        });
    </script>
  </div>
</div>