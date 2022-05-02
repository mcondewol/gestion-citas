<?php 
$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getById($reservation->pacient_id);
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
?> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link href="assets/css/material-dashboard.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Modificar Cita</h4>
  </div>
  <div class="card-content table-responsive">
<form class="form-horizontal" role="form" method="post" action="./?action=updatereservation">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Paciente</label>
    <div class="col-lg-4">
<select name="pacient_id" class="form-control" required>
<option readonly="readonly" value="<?php echo $pacients->id; ?>"><?php echo $pacients->id." - ".$pacients->name." ".$pacients->lastname; ?></option>
</select>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">DPI</label>
    <div class="col-md-4">
      <input readonly="readonly" type="text" name="DPI" value="<?php echo $pacients->DPI;?>" class="form-control" id="email" placeholder="DPI">
    </div>
</div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
    <div class="col-md-4">
      <input readonly="readonly" type="text" name="email" value="<?php echo $pacients->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-4">
      <input readonly="readonly" type="text" name="phone"  value="<?php echo $pacients->phone;?>"  class="form-control" id="inputEmail1" placeholder="Telefono">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-4">
      <select name="medic_id" class="form-control selectpicker" required data-live-search="true>
      <option value="">-- SELECCIONE --</option>
        <?php foreach($medics as $p):?>
          <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->medic_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

  </div> 

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-5">
      <input type="date" name="date_at" value="<?php echo $reservation->date_at; ?>" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-5">
      <input type="time" name="time_at" value="<?php echo $reservation->time_at; ?>" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="note" placeholder="Nota"><?php echo $reservation->note;?></textarea>
    </div>
    

  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-4">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->status_id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-4">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->payment_id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">

  </div>

    

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
      <button type="submit" class="btn btn-default">Actualizar Cita</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>

    $(function() {
        $('.selectpicker').selectpicker();
    });


    $(function () {
        $('#date_time').datetimepicker({
            inline: true,
            sideBySide: true,
            locale: 'es-ES'
        });
    });


</script> 