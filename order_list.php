<?php

    if($cat >= 1){
        $sql = $mysqli->query("SELECT o.id_order as id_order,
            o.encomenda as encomenda,
            o.preco as preco,
            o.estado as estado,
            m.name as name
            FROM orders o
            INNER JOIN members m
            ON o.id_user=m.id");
    }else{
        $sql = $mysqli->query("SELECT o.id_order as id_order,
            o.encomenda as encomenda,
            o.preco as preco,
            o.estado as estado,
            m.name as name
            FROM orders o
            INNER JOIN members m
            ON o.id_user=m.id
            WHERE o.id_user = $userid");
    }

?>
<script type="text/JavaScript">

    $(function(){
        
        $("td:not(.estado)").click(function(){
            var id_order = this.id;
            var url = 'orderview';
            var form = $('<form action="' + url + '" method="post"><input type="hidden" name="id_order" value="' + id_order + '" /></form>');
            $('body').append(form);
            form.submit();
        });

        $("#orderlist select").on("change", function(){

            var id = this.id;
            var estado = $('select[name=estado'+id+']').val();

            post_data = {
                'id': id,
                'estado': estado
            };

            $.ajax({
                type: 'post',
                url: 'includes/edit_order.php',
                data: post_data,
                dataType: 'json',
                error: function(xhr, ajaxOptions, thrownError){
                    alert("Error:\n" + thrownError);
                },
                success: function(response){
                    if(response.success == false){
                        alert("Ocorreu um erro inesperado!")
                    }
                }
            });

        });

        $("span.delete").click(function(){

            if(!confirm("Are you sure you want to delete this order?")){
                return false;
            }

            var id = this.id;

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
                        $("#"+id).parent().parent().slideUp();
                    }
                }
            });

        });

    });

</script>
<section id="orderlist">
    <div class="container paddingtop">
        <div class="row row-centered">
            <div class="col-md-12 col-centered">
                <h2 class="titulo">Order List</h2>
                <h3 class="texto" style="margin-bottom: -40px;">Check the received orders on the list bellow.</h3>
                <div id="successdiv" class="alert alert-success fade in">
                    <strong id="success"></strong>
                </div>
                <table class="table table-striped table-hover centertable" style="margin-bottom: 80px;">
                    <thead>
                        <tr style="background-color: #343A40; color: white;">
                            <th class="tabelatitulo">Buyer</th>
                            <th class="tabelatitulo">Value</th>
                            <th class="tabelatitulo">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($roworder = $sql->fetch_array()){
                                $id_order = $roworder['id_order'];
                                $encomenda = $roworder['encomenda'];
                                $preco = $roworder['preco'];
                                $estado = $roworder['estado'];
                                $name = $roworder['name'];
                        ?>
                        <tr class="pointer" style="background-color: white;">
                            <td id="<?php echo $id_order; ?>" class="tabelatexto"><?php echo $name; ?></td>
                            <td id="<?php echo $id_order; ?>" class="tabelatexto">€<?php echo $preco; ?> <span class="fa fa-eur"></span></td>
                            <?php if($cat >= 1){?>
                            <td class="tabelatexto estado">
                                <select class="custom-select inputcp" width="100px" id="<?php echo $id_order; ?>" name="estado<?php echo $id_order; ?>">
                                    <option value="0" <?php if($estado==0){echo 'selected';} ?>>Processing</option>
                                    <option value="1" <?php if($estado==1){echo 'selected';} ?>>Shipped</option>
                                    <option value="2" <?php if($estado==2){echo 'selected';} ?>>Waiting Payment</option>
                                </select>
                            </td>
                            <?php }else{
                                if($estado==0){
                                    echo '<td id="<?php echo $id_order; ?>" class="tabelatexto">Processing</td>';
                                }elseif($estado==1){
                                    echo '<td id="<?php echo $id_order; ?>" class="tabelatexto">Shipped</td>';
                                }elseif($estado==2){
                                    echo '<td id="<?php echo $id_order; ?>" class="tabelatexto">Waiting Payment</td>';
                                }
                            } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>