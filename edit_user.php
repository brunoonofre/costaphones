<?php
    if (isset($_POST['userid'])){
        $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
        $redirpage = "guser";
    }else{
        $userid = $_SESSION['user_id'];
        $redirpage = 'user';
    }

    $sqledituser = $mysqli->query("SELECT * FROM members WHERE id = ".$userid);
    $rowedituser = $sqledituser->fetch_array();

    $username = $rowedituser['username'];
    $email = $rowedituser['email'];
    $name = $rowedituser['name'];
    $estatuto = $rowedituser['category']*1;
?>
<script type="text/JavaScript" src="js/edit_user.js"></script> 
<section id="edit">
    <div class="container paddingtop paddingbottom">
        <div class="row">
            <div class="col-md-4 formcenter">
                <h2 class="titulo marginbottom">Dados de Utilizador</h2>
                <div id="successdiv" class="alert alert-success">
                    <strong id="success"></strong>
                </div>
                <div id="errordiv" class="alert alert-danger">
                    <strong id="error"></strong>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control inputcp" placeholder="Username" id="username" name="username" value="<?php echo $username;  ?>" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control  inputcp" placeholder="Email" name="email" value="<?php echo $email;  ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control  inputcp" placeholder="Name" name="name" value="<?php echo $name;  ?>" />
                </div>
                <?php if($redirpage == 'guser'){?>
                <div class="form-group">
                    <select class="form-control  inputcp" id="estatuto" name="estatuto">
                        <?php if ($estatuto == 2){?>
                        <option value="2">Administrador</option>
                        <option value="1">Colaborador</option>
                        <option value="0">Cliente</option>
                        <?php }else if ($estatuto == 1){?>
                        <option value="1">Colaborador</option>
                        <option value="2">Administrador</option>
                        <option value="0">Cliente</option>
                        <?php }else if ($estatuto == 0){?>
                        <option value="0">Cliente</option>
                        <option value="2">Administrador</option>
                        <option value="1">Colaborador</option>
                        <?php }?>
                    </select>
                </div>
                <?php } ?>
                <input type="hidden" name="userid" value="<?php echo $userid;?>">
                <input type="hidden" name="redirpage" value="<?php echo $redirpage;?>">
                <button id="edituserbtn" name="submit" class="btn-lg btn-primary btncp"><span class="fa fa-edit"></span> Editar</button>
            </div>
        </div>
    </div>
</section>
