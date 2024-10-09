<?php
    $success = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);
    
    //query for users
    $sqlguser = $mysqli->query("SELECT * FROM members WHERE id <> '".$_SESSION['user_id']."' ORDER BY id");
?>
<script type="text/javascript">
    $(function(){
        
        $("#userstable span.edit").click(function(){
           
            var userid = this.id;
           
            var url = 'edituser';
            var form = $('<form action="' + url + '" method="post"><input type="text" name="userid" value="' + userid + '" /></form>');
            $('body').append(form);
            form.submit();
           
        });
       
        $("#userstable span.delete").click(function(){
          
            if(!confirm("Tem a certeza que prentede eliminar este utilizador?")){
                return false;
            }
            
            var userid = this.id;
            
            post_data = {
                'userid': userid
            };
            
            $.ajax({
                type: 'post',
                url: 'includes/del_user.php',
                data: post_data,
                dataType: 'json',
                error: function(xhr, ajaxOptions, thrownError){
                    alert("Error:\n" + thrownError);
                },
                success: function(response){
                    if(response.success == false){
                        alert("Ocorreu um erro inesperado!")
                    }else{
                        $("#"+userid).parent().parent().slideUp();
                    }
                }
            });
          
        });
       
    });
</script>
<section id="user">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-12">
                <h2 class="titulo marginbottom">Gestão de Utilizadores</h2>
                <a href='adduser' class="btn-lg btn-primary btncp btncpsmall"><span class="fa fa-user-plus"></span> Adicionar Utilizador</a>
                <?php if (!empty($success)) { ?>
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php echo $success; ?></strong>
                    </div>
                <?php } ?>
                <table id="userstable" class="table table-striped table-hover centertable margintop marginbottom">
                    <thead>
                        <tr style="background-color: #343A40; color: white;">
                            <th class="tabelatitulo">Name</th>
                            <th class=".d-sm-none .d-md-block tabelatitulo">Username</th>
                            <th class=".d-sm-none .d-md-block tabelatitulo">Email</th>
                            <th class="tabelatitulo">Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rowguser = $sqlguser->fetch_array()){ ?>
                        <tr style="background-color: white;">
                            <td class="tabelatexto"><?php echo $rowguser['name']?></td>
                            <td class=".d-sm-none .d-md-block tabelatexto"><?php echo $rowguser['username']?></td>
                            <td class=".d-sm-none .d-md-block tabelatexto"><?php echo $rowguser['email']?></td>
                            <td class="tabelatexto"><?php if ($rowguser['category'] == 2){
                                echo 'Administrator';
                            }else if ($rowguser['category'] == 1){
                                echo 'Colaborator';
                            }else{
                                echo 'Client';
                            } ?></td>
                            <td>
                                <span style="cursor: pointer;"
                                      id="<?php echo $rowguser['id']?>" 
                                      class="fa fa-edit edit"></span>
                            </td>
                            <td>
                                <span style="cursor: pointer;"
                                      id="<?php echo $rowguser['id']?>" 
                                      class="fa fa-ban delete"></span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>