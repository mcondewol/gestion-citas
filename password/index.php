
<?php 
    include '../ajax/password_recovery.php';
    include '../ajax/random_string.php';
    echo "<input type='hidden' value={$ivPHP} id='ivJS'>";
    echo "<input type='hidden' value={$keyPHP} id='keyJS'>";
?>

<?php include ('../layouts/header.php'); ?>

    <?php if(!isset($_GET['id_request'])): ?>
        <div class="container-fluid">
            <div class="row row-header">
                <div class="col-lg-6 col-md-6 col-sm-12 img-title-header">
                    <a href="https://zambos.com/" target="_blank"><img src="../assets/img/logo_header.png" alt="" class="img-header-logo"></a>
                </div>
                <!-- BOTONES -->
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <button type="button" class="btn btn-dark btn-lg btn-center-header" onclick="location.href='../inicio'">INICIO</button>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center bg-password">
                    <div class="col-lg-12 col-sm-12 text-center col-img-password">        
                        <img src="../assets/img/logo.png" alt="" class="img-password">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <form name="form-recovery" id="form-recovery" method="GET" class="col-password">
                            <div class="form-group">
                                <label for="email-recovery">Correo electrónico</label>
                                <input type="email" class="form-control" name="email-recovery" id="email-recovery" aria-describedby="emailHelp" placeholder="Escriba su correo electrónico">
                                <small id="email-warning-2" class="form-text text-muted"></small>
                            </div>
                            <div class="row justify-content-center" style="margin-bottom:10px;">
                                <!-- DEV  -->
                                <!-- <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div> -->
                                <!-- <div class="g-recaptcha" data-sitekey="6LeRalEaAAAAAGkOEyJDt7NNVe0nQZFnWT_IM5ad"></div> -->
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary btn-block" id="btn-recovery">RECUPERAR CONTRASEÑA</button>    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <?php 
            $id_request = $_GET["id_request"];
            $password_data = [false];
            if(strlen($id_request) == 64){
                $password = new Password();
                $password_data = $password->validar_id($dbhost, $id_request);    
            }
        ?>
        <?php if($password_data[0]): ?>
            <div class="container-fluid">
                <div class="row row-header">
                    <div class="col-lg-6 col-md-6 col-sm-12 img-title-header">
                        <a href="https://zambos.com/" target="_blank"><img src="../assets/img/logo_header.png" alt="" class="img-header-logo"></a>
                    </div>
                    <!-- BOTONES -->
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <button type="button" class="btn btn-dark btn-lg btn-center-header" onclick="location.href='../inicio'">INICIO </button>
                    </div>
                </div>
                <div class="row justify-content-center" style="margin-top:10vh;">
                    <div class="col-lg-3 col-sm-12">
                        <form name="form-update" id="form-update" method="GET">
                            <input type="hidden" id="id-recovery" value="<?php echo $password_data[1]['id'];?>">
                            <input type="hidden" id="id-request" value="<?php echo $password_data[1]['key_request'];?>">
                            <div class="form-group">
                                <label for="password-recovery">Nueva contraseña</label>
                                <input type="password" class="form-control" name="password-recovery" id="password-recovery" aria-describedby="" placeholder="Escriba su nueva contraseña">
                                <small id="password-warning" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="password-recovery-2">Repita la contraseña</label>
                                <input type="password" class="form-control" name="password-recovery-2" id="password-recovery-2" aria-describedby="" placeholder="Repita su contraseña">
                                <small id="password-warning-2" class="form-text text-muted"></small>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary btn-block" id="btn-update">CAMBIAR CONTRASEÑA</button>    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php header('Location: ../'); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php include ('../layouts/footer.php'); ?>

