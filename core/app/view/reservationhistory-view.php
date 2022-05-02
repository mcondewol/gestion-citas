<?php 
$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getById($reservation->pacient_id);
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
?>
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
<select name="pacient_id" class="form-control" required disabled>
<option readonly="readonly" value="<?php echo $pacients->id; ?>"><?php echo $pacients->id." - ".$pacients->name." ".$pacients->lastname; ?></option>
</select>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">DPI</label>
    <div class="col-md-4">
      <input readonly="readonly" type="text" name="DPI" value="<?php echo $pacients->dpi;?>" class="form-control" id="email" placeholder="DPI" disabled>
    </div>
</div>
<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
    <div class="col-md-4">
      <input readonly="readonly" type="text" name="email" value="<?php echo $pacients->email;?>" class="form-control" id="email" placeholder="Email" disabled>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-4">
      <input readonly="readonly" type="text" name="phone"  value="<?php echo $pacients->phone;?>"  class="form-control" id="inputEmail1" placeholder="Telefono" disabled>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-4">
<select name="medic_id" class="form-control" required disabled>
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
      <input type="date" name="date_at" value="<?php echo $reservation->date_at; ?>" required class="form-control" id="inputEmail1" placeholder="Fecha" disabled>
    </div>
    <div class="col-lg-5">
      <input type="time" name="time_at" value="<?php echo $reservation->time_at; ?>" required class="form-control" id="inputEmail1" placeholder="Hora" disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="note" placeholder="Nota" disabled><?php echo $reservation->note;?></textarea>
    </div>
    

  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-4">
<select name="status_id" class="form-control" required disabled>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->status_id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-4">
<select name="payment_id" class="form-control" required disabled>
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
      <a class="btn btn-warning" href="./?view=reservations">Regresar</a>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>