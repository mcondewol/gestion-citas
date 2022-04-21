<?php 
/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
session_start();
?>

<?php include ('../layouts/header.php'); ?>
    <div class="container bg-light rounded">
        <div class="h4 font-weight-bold text-center py-3">Administración de Catalogos</div>
        <div class="row">
            <div class="col-lg-4 col-md-6 my-lg-0 my-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                    <a href="ubicaciones.php">
                        <div class="rounded-circle mx-3 text-center d-flex align-items-center justify-content-center blue"> <img src="https://www.seekpng.com/png/detail/347-3471244_punto-de-ubicacion-png-direction-sign-icon-png.png" style="width: 60%;" alt=""> </div>
                        <div class="d-flex flex-column"> <b>Ubicaciones</b> </div>
                    </a> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-lg-0 my-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                    <a href="/ubicaciones.php">
                        <div class="rounded-circle mx-3 text-center d-flex align-items-center justify-content-center blue"> <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.kPyeBZdfp67IgGOU8i5H8gHaHa%26pid%3DApi&f=1" style="width: 50%;" alt=""> </div>
                        <div class="d-flex flex-column"> <b>Especialidades</b> </div>
                    </a> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-lg-0 my-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                    <a href="#" onclick="open_modal(3);">
                        <div class="rounded-circle mx-3 text-center d-flex align-items-center justify-content-center blue"> <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse2.mm.bing.net%2Fth%3Fid%3DOIP.eeHqWtBXcxvWLnB9x506xgHaHa%26pid%3DApi&f=1" style="width: 50%;" alt=""> </div>
                        <div class="d-flex flex-column" > <b>Medicos</b> </div>
                    </a> 
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- MODAL DOCTORES-->
    <div class="modal fade" id="modal-registration-doctor" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">REGISTRO DE MÉDICOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="form-registration-doctor" id="form-registration-doctor" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Escriba su nombre" autocomplete="off">
                                <small id="name-warning" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="gender">Espcialidad</label>
                                <select class="form-control" id="specialty">
                                    <option value="1">Médicina Interna</option>
                                    <option value="2">Pediatria</option>
                                    <option value="3">Traumatología y Ortopedia</option>
                                    <option value="4">Cirugía General</option>
                                    <option value="5">Dermatología</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-block" id="btn-register-doctor">INGRESAR</button>    
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">CANCELAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/form-validations.js"></script>