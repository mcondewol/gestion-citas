<?php 
/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
session_start();
include '../ajax/ubicaciones.php';
$ubicaciones = new Ubicaciones();
$opciones_categoria = $ubicaciones->get_all($dbhost);
?>

<?php include ('../layouts/header.php'); ?>
<div class="container bg-light rounded">
    <div class="h4 font-weight-bold text-center py-3">Ubicaciones</div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Municipio</th>
      <th scope="col">Departamento</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $opciones_categoria; ?>
  </tbody>
</table>
        
    </div>
</div>