<?php 
/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
session_start();
include '../ajax/ubicaciones.php';
$ubicaciones = new Ubicaciones();
$ubicaciones_list = $ubicaciones->getList($dbhost);
?>

<?php include ('../layouts/header.php'); ?>
<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
<div class="row">
    <div class="col-md-10">
        <h1> Nueva Cita </h1>
        <form name="form-registration-cita" id="form-registration-cita" autocomplete="off" >
            <div class="form-group">
                <label for="ubicacion" class="col-lg-2 control-label">Ubicacion</label>
                
                <div class="col-lg-10">
                <select name="ubicacion" id="ubicacion-list" class="form-control" required>
                <option value="">-- SELECCIONE --</option>
                <?php echo $ubicaciones_list; ?>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Especialdiad</label>
                
                <div class="col-lg-10">
                <select name="especialidad" id="especialidad-list" class="form-control" required>
                <option value="">-- SELECCIONE --</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Doctor</label>
                
                <div class="col-lg-10">
                <select name="medicos" id="medicos-list" class="form-control" required>
                <option value="">-- SELECCIONE --</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="dtp_input1" class="col-md-2 control-label">Fecha / Hora de Cita</label>
                <div class="input-group date form_datetime col-md-5" data-date="2021-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" name="date" size="16" type="text" value="" readonly>
                    <span  ><span class="fas fa-times-circle"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<input type="hidden" id="dtp_input1" value="" /><br/>
            </div>        
            <div class="form-group">
                <div class="col-lg-10">
                    <button type="button" class="btn btn-primary btn-block" id="btn-register-cita">INGRESAR</button>    
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">CANCELAR</button>
                </div>
                <div class="col-6">
                    
                </div>
            </div>
        </form>
    </div>  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$('#ubicacion-list').on('change', function(){
    var ubicacion_id = this.value;
    $.ajax({
    type: "POST",
    url: "../ajax/especialidad.php",
    data:'ubicacion_id='+ubicacion_id,
    success: function(result){
    $("#especialidad-list").html(result);
    }
    });
});
$('#especialidad-list').on('change', function(){
    var especialidad_id = this.value;
    $.ajax({
    type: "POST",
    url: "../ajax/medicos.php",
    data:'especialidad_id='+especialidad_id,
    success: function(result){
    $("#medicos-list").html(result);
    }
    });
});
</script>

<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="../js/form-validations.js"></script>