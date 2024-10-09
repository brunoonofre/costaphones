<?php
    $address = $mysqli->query("SELECT a.street as street,
        a.city as city,
        a.state as state,
        s.country as country,
        a.zip as zip,
        a.phone as phone 
        FROM addresses a
        INNER JOIN shipping s
        ON s.id_shipping=a.country 
        WHERE a.id_user = $userid");
    if($address->num_rows == 0){
        $morada = 0;
    }else{
        $morada = 1;
    };
    $rowaddress = $address->fetch_array();
    $success = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);
?>
<section id="user">
    <div class="container paddingtop">
            <?php if (!empty($success)) { ?>
                <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $success; ?></strong>
                </div>
            <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <h2 class="titulo marginbottom">Your Data</h2>
                <h3 class="texto" style="margin-top: -15px; margin-bottom: -5px">How do you want to be identified?</h3>
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Name:</td>
                            <td class="tabelatexto"><?php echo $name_user; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Username:</td>
                            <td class="tabelatexto"><?php echo $username; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Email:</td>
                            <td class="tabelatexto"><?php echo $useremail; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Status:</td>
                            <td class="tabelatexto">
                                <?php if ($cat == 0){ ?>
                                Client
                                <?php }else if($cat == 1){?>
                                Collaborator
                                <?php }else if($cat == 2){?>
                                Administrator
                                <?php }?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center">
                    <button onClick="window.location.href = 'edituser'" role="button" class="btn-lg btn-primary btncp btncpsmall edit"><span class="fa fa-edit"></span> Edit Data</button>
                    <button onClick="window.location.href = 'editpw'" role="button" class="btn-lg btn-primary btncp btncpsmall edit"><span class="fa fa-key"></span> Change Password</button>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="titulo marginbottom">Your Adress</h2>
                <h3 class="texto" style="margin-top: -15px; margin-bottom: -5px">Where should we ship your order to?</h3>
                <?php if($morada == 0){?>
                <p>You haven't entered an adress!</p>
                <button onClick="window.location.href = 'addaddress'" role="button" class="btn-lg btn-primary btncp btncpsmall edit"><span class="fa fa-plus"></span> Add Adress</button>
                <?php }else{?>
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Street:</td>
                            <td class="tabelatexto"><?php echo $rowaddress['street']; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">City:</td>
                            <td class="tabelatexto"><?php echo $rowaddress['city']; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">State:</td>
                            <td class="tabelatexto"><?php echo $rowaddress['state']; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Country:</td>
                            <td class="tabelatexto"><?php echo ucfirst($rowaddress['country']); ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Zip Code:</td>
                            <td class="tabelatexto"><?php echo $rowaddress['zip']; ?></td>
                        </tr>
                        <tr style="background-color: white;">
                            <td class="tabelatitulo">Phone:</td>
                            <td class="tabelatexto"><?php echo $rowaddress['phone']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center">
                    <button onClick="window.location.href = 'editaddress'" role="button" class="btn-lg btn-primary btncp btncpsmall edit"><span class="fa fa-edit"></span> Edit Adress</button>
                    <?php };?>
                </div>
            </div>
        </div> 
    </div>
</section>