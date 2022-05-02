
<?php
$pacients = PacientData::getAll();
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
                <h4>Nueva Cita</h4>
            </div> 
            <div class="card-content table-responsive" style="width: 90%;">
                <form class="form-horizontal" role="form" method="post" action="./?action=addreservation">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Asunto</label>
                        <div class="col-lg-10">
                            <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Asunto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Paciente</label>
                        <div class="col-lg-10">
                            <select name="pacient_id" class="form-control selectpicker" required data-live-search="true">
                                <option value="">-- SELECCIONE --</option>
                                <?php foreach($pacients as $p):?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
                        <div class="col-lg-10">
                            <select name="medic_id" class="form-control selectpicker" required data-live-search="true" id="medic_id">
                                <option value="">-- SELECCIONE --</option>
                                <?php foreach($medics as $p):?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-6">
                        <table class="table table-bordered border-primary hidden" id="table_schedule_week">
                            <caption>Horario entre semana</caption>
                            <thead>
                            <tr>
                                <th scope="col">Dias</th>
                                <th scope="col">Horario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered border-primary hidden" id="table_schedule_weekend">
                            <caption>Horario fin de semana</caption>
                            <thead>
                            <tr>
                                <th scope="col">Dias</th>
                                <th scope="col">Horario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            </tbody>
                        </table>
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
                        <div class="col-lg-10">
                            <textarea class="form-control" name="note" placeholder="Nota"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Enfermedad</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="sick" placeholder="Enfermedad"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="symtoms" placeholder="Sintomas"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Medicamentos</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="medicaments" placeholder="Medicamentos"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
                        <div class="col-lg-10">
                            <select name="status_id" class="form-control" required>
                                <?php foreach($statuses as $p):?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
                        <div class="col-lg-10">
                            <select name="payment_id" class="form-control" required>
                                <?php foreach($payments as $p):?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Costo</label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                <input type="text" class="form-control" name="price" placeholder="Costo">
                            </div>
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
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>

$('#medic_id').on('change', function(){
      const medic_id = this.value;
      const tdWeek = document.querySelectorAll('#table_schedule_week tbody tr td');
      const tableWeek = document.querySelector('#table_schedule_week');

      const tableWeekend = document.querySelector('#table_schedule_weekend');
      const tdWeekend = document.querySelectorAll('#table_schedule_weekend tbody tr td');

      $.ajax({
          type: "POST",
          url: "core/app/model/ajaxScheduleMedic.php",
          data:{medic_id},
          success: function(result){
              const {esemana, week_start, week_end, fsemana, weekend_start, weekend_end} = JSON.parse(result)

              tdWeek[0].textContent = esemana;
              tdWeek[1].textContent = `${week_start} a ${week_end}`;
              tableWeek.classList.remove('hidden');

              if(fsemana != ''){
                  tdWeekend[0].textContent = fsemana;
                  tdWeekend[1].textContent = `${weekend_start} a ${weekend_end}`;
                  tableWeekend.classList.remove('hidden');
              }else{
                  tableWeekend.classList.add('hidden');
              }
          }
      });

  });

    $(function() {
        $('.selectpicker').selectpicker();
    });


</script>