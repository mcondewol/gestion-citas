  <!-- DATATABLE PLUGIN -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.jqueryui.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.jqueryui.js"></script>
 

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Ubicaciones</h4>
			</div>
			<div class="card-content table-responsive">
				<a href="index.php?view=newlocation" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Ubicacion</a>
				<table id="dt_ubicaciones" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Municipio</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Municipio</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
        tablaDoctores = $('#dt_ubicaciones').DataTable({
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
            scrollX: true,
            processing: true,      
            ajax: {
                url: "ajax/get_data.php",
                type: "POST",
                data: function (data) {
                    data.opcion = 3;
                }
            },
            columns: [
                { "data": "ubicacion" },
				{ "data": "municipio" },
                { "data": "departamento" },
                { "data": "acciones" }
            ],
            order: [1, 'asc'],
        });
    });
</script>