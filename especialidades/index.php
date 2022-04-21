<?php 
/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
session_start();
?>

<?php include ('../layouts/header.php'); ?>
<div class="container bg-light rounded">
    <div class="h4 font-weight-bold text-center py-3">Administración de Catalogos (Especialidades)</div>

    <div class="row">
        <div class="col-lg-12">
            <table id="dt_especialidad" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Especialidad</th>
                        <th></th>
                        <th>Ubicación</th>
                        <th>Modificado</th>
                        <th>Creado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Especialidad</th>
                        <th></th>
                        <th>Ubicación</th>
                        <th>Modificado</th>
                        <th>Creado</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- MODAL ESPECIALIDADES-->
<div class="modal fade" id="modal-registration-speciality" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">REGISTRO DE ESPECIALIDADES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="form-registration-speciality" id="form-registration-speciality" autocomplete="off">
                    <input type="hidden" class="form-control" name="id" id="id">
                    <div class="row">
                        <div class="col">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre de la especialidad" autocomplete="off">
                            <small id="name-warning" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="location">Ubicación</label>
                            <select id="location" class="form-control selectpicker" data-live-search="true">
                                
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col" id="div-btn-speciality">
                            <button type="button" class="btn btn-primary btn-block" id="btn-register-speciality">INGRESAR</button>    
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

<!-- Latest compiled and minified JavaScript -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="../js/index.js"></script>
<script src="../js/form-validations.js"></script>
<script src="../assets/js/functions.js"></script>
<script>
    $(document).ready(function() {

        tablaEspecialidades = $('#dt_especialidad').DataTable({
            dom: "<'row customDttables' <'col-sm-6 col-lg-6 dt-left' l><'col-sm-6 col-lg-6 dt-right' f>> <'row customDttables' <'col-sm-12 col-md-12 col-lg-12'>><t><ip>",
            language: {
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron registros.",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>Cargando datos...',
                info: "Mostrando pagina _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(filtrando de _MAX_ registros)",
                search: "Buscar:",
                paginate: {
                    previous: "Anterior",
                    next: "Siguiente"
                },
                select: {
                    rows: {
                        _: "%d Registros seleccionados",
                        0: "Ninguno seleccionado.",
                        1: "1 Registro seleccionado"
                    }
                },
            },
            pageLength: 10,
            lengthMenu: [10, 15, 25, 50, 75, 100],
            fixedColumns: true,
            scrollX: true,
            processing: true,      
            ajax: {
                url: "../ajax/get_data.php",
                type: "POST",
                data: function (data) {
                    data.opcion = 2;
                }
            },
            columns: [
                { "data": "id_especialidad" },
                { "data": "especialidad" },
                { "data": "id_ubicacion" },
                { "data": "ubicacion" },
                { "data": "fechaing" },
                { "data": "fechamod" },
            ],
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": false
                },
                {
                    "targets": [ 2 ],
                    "visible": false
                }
            ],
            select: true,
        });
        let buttons = `<div class='btn-dt'>
                            <button class='btn btn-outline-primary mr-2' onclick='openModal(1,2)'><i class='fa fa-plus-circle' style='color:rgb(26, 178, 255);'></i> <h8 class='hidden-xs hidden-sm hidden-md'>Nueva</h8></button>
                            <button class='btn btn-outline-secondary mr-2' onclick='openModal(2,2)'><i class='fa fa-pencil' style='color:rgb(89, 89, 166);'></i> <h8 class='hidden-xs hidden-sm hidden-md'>Modificar</h8></button>
                            <button class='btn btn-outline-danger mr-2' onclick='openModal(3,2)'><i class='fa fa-trash' style='color:#ef0202;'></i> <h8 class='hidden-xs hidden-sm hidden-md'>Eliminar</h8></button>
                            <button class='btn btn-outline-success' onclick='openModal(4,2)'><i class='fa fa-refresh' style='color:green;'></i> <h8 class='hidden-xs hidden-sm hidden-md'>Recargar</h8></button>
                        </div>`;
        $("div.col-sm-12").html(buttons);
    });
</script>