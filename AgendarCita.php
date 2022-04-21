<?php
include "core/autoload.php";

include 'core/app/model/MedicData.php';
include 'core/app/model/CategoryData.php';
include 'core/app/model/LocationData.php';
include 'core/app/model/UserData.php';
$medics = MedicData::getAll();
$categories = CategoryData::getAll();
$locations = LocationData::getAll();
?>

<!doctype html>
<html lang="en">
<head>  
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>APROFAM - Dashboard</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link href="assets/css/material-dashboard.css" rel="stylesheet"/>
<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>    
<?php endif; ?> 

</head>

<body>
<?php if(true):?>
  <div class="wrapper">

      <div class="sidebar" data-color="blue">
      <div class="logo">
        <a href="./" class="simple-text">
          <img src="img/Logo-aprofam.png" class="img-fluid main-logo" alt="APROFAM">
        </a>
      </div>

      <div class="sidebar-wrapper">
              <ul class="nav">
                 
                  <li>
                      <a href="./AgendarCita.php">
                          <i class="fa fa-calendar"></i>
                          <p>Citas</p>
                      </a>
                  </li>
                  <li>
                      <a href="./oldresrvations.php">
                        <i class="fa fa-support"></i>
                          <p>Reservaciónes</p>
                      </a>
                  </li>
              </ul>
        </div>
      </div>

      <div class="main-panel">
      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><b>Sistema de Citas Medicas</b></a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php">Salir</a></li>
                </ul>
              </li>
            </ul>
<!--
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group  is-empty">
                <input type="text" class="form-control" placeholder="Search">
                <span class="material-input"></span>
              </div>
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="fa fa-search"></i><div class="ripple-container"></div>
              </button>
            </form>
            -->
          </div>
        </div>
      </nav>

      <div class="content">
      <?php

?>

<div class="row">
<div class="col-md-10">
<h1>Nueva Cita</h1>
<form class="form-horizontal" role="form" method="post" action="core/app/action/addres-action.php">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" id="category_id" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Ubicacion*</label>
    <div class="col-md-6">
    <select name="idubicacion" id="idubicacion" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($locations as $cat):?>
    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-6">
    <select name="medic_id" id="medic_id" class="form-control" required>
    <option value="">-- SELECCIONE --</option>
      <?php foreach($medics as $p):?>
        <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
      <?php endforeach; ?>
    </select>
    </div>
  </div>
  <div class="form-group">
      <label for="date" class="col-lg-2 control-label">Fecha</label>
      <div class="col-lg-10">
          <div id="datetimepicker12"></div>
      </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-5">
      <input type="date" name="date_at" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-5">
      <input type="time" name="time_at" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Agregar Cita</button>
    </div>
  </div>
</form>

</div>
</div>
      <div class="container-fluid">

</div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul>
              
        <!--
              <li>
                <a href="#">
                  Company
                </a>
              </li>
              <li>
                <a href="#">
                  Portfolio
                </a>
              </li>
              <li>
                <a href="#">
                   Blog
                </a>
              </li>
          -->
            </ul>
          </nav>
          
        </div>
      </footer>
    </div>
  </div>
<?php else:?>
 

<?php endif;?>
</body>

  <!--   Core JS Files   -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/material.min.js" type="text/javascript"></script>

  <!--  Charts Plugin -->
  <script src="assets/js/chartist.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>

  <!--  Google Maps Plugin    -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

  <!-- Material Dashboard javascript methods -->
  <script src="assets/js/material-dashboard.js"></script>

  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/js/demo.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){

      // Javascript method's body can be found in assets/js/demos.js
          demo.initDashboardPageCharts();

      });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
  $('#idubicacion').on('change', function(){
      let ubicacion_id = this.value;
      let especialidad_id = $("#category_id").val();
      $.ajax({
      type: "POST",
      url: "core/app/model/MedicA.php",
      data:{ubicacion_id, especialidad_id},
      success: function(result){
      $("#medic_id").html(result);
      }
      });
  });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#datetimepicker12').datetimepicker({
        inline: true,
        sideBySide: true,
        locale: 'es-GT'
    });
</script>
</html>
