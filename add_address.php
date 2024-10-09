<?php
    $address = $mysqli->query("SELECT * FROM addresses WHERE id_user = $userid");
    if($address->num_rows > 0){
        header('Location: user'); 
    };
?>
<script type="text/JavaScript" src="js/add_address.js"></script>
<div class="container paddingtop paddingbottom">
    <div class="row">
        <div class="col-md-4 formcenter">
            <h2 class="titulo marginbottom">Shipping Adress</h2>
            <div id="successdiv" class="alert alert-success">
                <strong id="success"></strong>
            </div>
            <div id="errordiv" class="alert alert-danger">
                <strong id="error"></strong>
            </div>
            <!--<form action="index.php?pag=edituser&nav=8&alterar=1" method="post" id="edit_form">-->
            <div class="form-group">
                <input type="text" class="form-control inputcp" placeholder="Street" name="street" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control inputcp" placeholder="City" name="city" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control inputcp" placeholder="State" name="state" />
            </div>
            <div class="form-group">
            <select class="custom-select inputcp" name="country" id="country">
                <option value="" disabled selected style='display:none;'>Country</option>
                <?php  
                    $queryshipping = $mysqli->query("SELECT * FROM shipping ORDER BY country ASC");
                    while($rowshipping = $queryshipping->fetch_array()){ ?>
                <option value="<?php echo $rowshipping['id_shipping'] ?>"><?php echo ucfirst($rowshipping['country']); ?></option>
                <?php } ?>
            </select>
            </div>
            <div class="form-group">
                    <input type="tel" class="form-control inputcp" placeholder="Zip" name="zip" />
            </div>
            <div class="form-group">
                <input type="tel" class="form-control inputcp" placeholder="Phone" name="phone" />
            </div>
            <input type="hidden" name="userid" value="<?php echo $userid;?>">
            <button id="addaddressbtn" class="btn-lg btn-primary btncp"><span class="fa fa-plus"></span> Save Address</button>
        </div>
    </div>
</div>