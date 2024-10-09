<?php
    $success = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);
    
    //query for users
    $sqlshipping = $mysqli->query("SELECT * FROM shipping ORDER BY country ASC");
?>
<script type="text/JavaScript" src="js/shipping.js"></script>
<section id="user">
    <div class="container paddingtop">
        <div class="row row-centered">
            <div class="col-md-6 col-centered">
                <h2 class="titulo marginbottom">Shipping Locations</h2>
                <a href='addshipping' class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-user-plus"></span> New shipping location</a>
                <?php if (!empty($success)) { ?>
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php echo $success; ?></strong>
                    </div>
                <?php } ?>
                <div id="successdiv" class="alert alert-success">
                    <strong id="success"></strong>
                </div>
                <table id="userstable" class="table table-striped table-hover centertable margintop marginbottom">
                    <thead>
                        <tr style="background-color: #343A40; color: white;">
                            <th class="tabelatitulo">Country</th>
                            <th class="tabelatitulo">Shipping Price</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rowshipping = $sqlshipping->fetch_array()){ ?>
                        <tr style="background-color: white;">
                            <td class="tabelatexto"><?php echo $rowshipping['country']?></td>
                            <td class="tabelatexto">
                                <input class="form-control inputcp" style="width:80px" id="<?php echo $rowshipping['id_shipping']?>" type="number" name="shipcost<?php echo $rowshipping['id_shipping']?>" value="<?php echo $rowshipping['shipcost']?>"/></td>
                            <td>
                                <span style="cursor: pointer;"
                                      id="<?php echo $rowshipping['id_shipping']?>" 
                                      class="fa fa-check edit"></span>
                            </td>
                            <td>
                                <span style="cursor: pointer;"
                                      id="<?php echo $rowshipping['id_shipping']?>" 
                                      class="fa fa-ban delete"></span>
                            </td>
                        </tr>
                        <?php } ?>
                        <script>        
                            $("input[name*=shipcost]").on('change keyup',function(){
                                var id = this.id;
                                $("#"+id+".edit").show();
                            });
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>