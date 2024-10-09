<?php
    $sqleditaddress = $mysqli->query("SELECT a.street as street,
        a.city as city,
        a.state as state,
        a.country as country_id,
        s.country as country,
        a.zip as zip,
        a.phone as phone 
        FROM addresses a
        INNER JOIN shipping s
        ON s.id_shipping=a.country 
        WHERE a.id_user = $userid");
    $roweditaddress = $sqleditaddress->fetch_array();

    $street = $roweditaddress['street'];
    $city = $roweditaddress['city'];
    $state = $roweditaddress['state'];
    $countryid = $roweditaddress['country_id'];
    $country = $roweditaddress['country'];
    $zip = $roweditaddress['zip'];
    $phone = $roweditaddress['phone'];
?>
<script type="text/JavaScript" src="js/edit_address.js"></script>
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
                <input type="text" class="form-control inputcp" placeholder="Street" name="street" value="<?php echo $street;?>"/>
            </div>
            <div class="form-group">
                <input type="email" class="form-control inputcp" placeholder="City" name="city" value="<?php echo $city;?>"/>
            </div>
            <div class="form-group">
                <input type="email" class="form-control inputcp" placeholder="State" name="state" value="<?php echo $state;?>"/>
            </div>
            <div class="form-group">
                <select class="custom-select inputcp" name="country" id="country">
                    <option value="<?php echo $countryid;?>" selected style='display:none;'><?php echo $country;?></option>
                    <?php  
                        $queryshipping = $mysqli->query("SELECT * FROM shipping ORDER BY country ASC");
                        while($rowshipping = $queryshipping->fetch_array()){ ?>
                    <option value="<?php echo $rowshipping['id_shipping'] ?>"><?php echo ucfirst($rowshipping['country']); ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="form-group">
                <input type="tel" class="form-control inputcp" placeholder="Zip" name="zip" value="<?php echo $zip;?>"/>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control inputcp" placeholder="Phone" name="phone" value="<?php echo $phone;?>"/>
            </div>
            <input type="hidden" name="userid" value="<?php echo $userid;?>">
            <button id="addaddressbtn" class="btn-lg btn-primary btncp"><span class="fa fa-edit"></span> Save Changes</button>
        </div>
    </div>
</div>