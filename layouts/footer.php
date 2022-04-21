
    <!-- MODAL REGISTER-->
    <div class="modal fade" id="modal-registration" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">REGISTRATE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="form-registration" id="form-registration" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Escriba su nombre" autocomplete="off">
                                <small id="name-warning" class="form-text text-muted"></small>
                            </div>
                            <div class="col">
                                <label for="last_name">Apellido</label>
                                <input type="text" class="form-control" name="last-name" id="last-name" placeholder="Escriba su apellido" autocomplete="off">
                                <small id="last-name-warning" class="form-text text-muted"></small>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="phone">Teléfono</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Escriba su No. de Celular" onkeydown="return onKeyDownHandler(event, this.value, 8);">
                                <small id="phone-warning" class="form-text text-muted"></small>
                            </div>
                            <div class="col">
                                <label for="email">Correo electrónico</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Escriba su correo electrónico" autocomplete="off">
                                <small id="email-warning" class="form-text text-muted"></small>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col">
                                <label for="dpi">DPI</label>
                                <input type="text" class="form-control" name="dpi" id="dpi" placeholder="Escriba su DPI" onkeydown="return onKeyDownHandler(event, this.value, 13);"  autocomplete="off">
                                <small id="dpi-warning" class="form-text text-muted"></small>
                            </div>
                            <div class="col">
                                <label for="birthday">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="birthday" id="birthday" autocomplete="off">
                                <small id="birthday-warning" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="gender">Genero</label>
                                <select class="form-control" id="gender">
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                    <option value="3">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                <small id="password-warning" class="form-text text-muted"></small>
                            </div>
                            <div class="col">
                                <label for="password2">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Contraseña">
                                <small id="password2-warning" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-block" id="btn-register">REGISTRARSE</button>    
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

     <!-- MODAL LOGIN-->
     <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">INICIAR SESIÓN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="form-login" id="form-login">
                        <div class="form-group">
                            <label for="email-login">Correo electrónico</label>
                            <input type="email" class="form-control" name="email-login" id="email-login" aria-describedby="emailHelp" placeholder="Escriba su correo electrónico">
                            <small id="email-warning-2" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="password-login">Contraseña</label>
                            <input type="password" class="form-control" name="password-login" id="password-login" placeholder="Contraseña">
                            <small id="password-warning-2" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group text-center">
                            <label class="form-check-label" for="check-terminos"><a href="../password" target="_blank">¿Olvide mi contraseña?</a></label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary btn-block" id="btn-login-form">INICIAR SESIÓN</button>    
                            </div>
                            <div class="col-sm-6">
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
</body>
</html>