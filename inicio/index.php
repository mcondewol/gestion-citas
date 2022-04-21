<?php 
/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
session_start();
include '../ajax/random_string.php';
echo "<input type='hidden' value={$ivPHP} id='ivJS'>";
echo "<input type='hidden' value={$keyPHP} id='keyJS'>";
?>

<?php include ('../layouts/header.php'); ?>

<div class="container-fluid" style="background-color: #1160C7">
    <div class="row row-header" >
        <div class="col-lg-6 col-md-6 col-sm-12 img-title-header">
                <a href="#"><img src="../assets/img/aprofam-logo-blanco-1.png" alt="" class="img-header-logo"></a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 text-right">
            <?php 
            if (isset($_SESSION['id'])) {
                echo "<button type='button' class='btn btn-dark btn-lg btn-center-header' id='btn-nombre' >".$_SESSION['id']."</button>
                <button type='button' class='btn btn-dark btn-lg btn-center-header' id='btn-logout' onclick='open_modal(2);'>CERRAR SESIÓN</button>";
            } else {
                echo "<button type='button' class='btn btn-dark btn-lg btn-center-header' id='btn-registro' onclick='open_modal(1);'>REGISTRATE</button>
                <button type='button' class='btn btn-dark btn-lg btn-center-header' id='btn-login' onclick='open_modal(2);'>INICIAR SESIÓN</button>";
            }
            ?>
            
        </div>
    </div>
</div>
<div class='body'>
    <div class="row">
        <?php 
        if (isset($_SESSION['id'])) {
            echo "<a class='btn btn-lg btn-success' href='/gestion-citas/Citas/us'>Agendar Cita</a>";
        } else {
            echo "<a class='btn btn-lg btn-success' href='/gestion-citas/Citas'>Agendar Cita</a>";
        }
        ?>
        
    </div>
</div>


<?php include ('../layouts/footer.php'); ?>

