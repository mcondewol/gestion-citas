function openModal(tipo, opcion){
    if(tipo == 1){
        if(opcion == 1){
            $("#form-registration-doctor")[0].reset();
            $("#div-btn-doctor").html(`<button type="button" class="btn btn-primary btn-block" id="btn-register-doctor" onclick="saveDoctor()">INGRESAR</button>`);
            $("#modal-registration-doctor").modal('toggle');
        }else if(opcion  == 2){
            $("#form-registration-speciality")[0].reset();
            $("#div-btn-speciality").html(`<button type="button" class="btn btn-primary btn-block" id="btn-register-doctor" onclick="saveSpeciality()">INGRESAR</button>`);
            fetch('../ajax/get_location.php')
            .then( response => response.json())
            .then( jsonResponse => {
                $("#location").html(jsonResponse.data);
                $("#location").selectpicker("refresh");
                $("#modal-registration-speciality").modal('toggle');
            })
            
        }else if(opcion == 3){
            $("#form-registration-location")[0].reset();
            $("#div-btn-location").html(`<button type="button" class="btn btn-primary btn-block" id="btn-register-doctor" onclick="saveLocation()">INGRESAR</button>`);
            let body = new FormData();
            body.append('opcion', 1);
            fetch('../ajax/get_data_location.php',{
                method: 'POST',
                body: body,
            })
            .then( response => response.json())
            .then( jsonResponse => {
                $("#departamento").html(jsonResponse.data);
                $("#departamento").selectpicker("refresh");
                let body = new FormData();
                body.append('opcion', 2);
                body.append('id_departamento', 1);
                fetch('../ajax/get_data_location.php',{
                    method: 'POST',
                    body: body,
                })
                .then( response => response.json())
                .then( jsonResponse => {
                    $("#municipio").html(jsonResponse.data);
                    $("#municipio").selectpicker("refresh");
                    $("#modal-registration-location").modal('toggle');
                });
            });
        }
    }else if(tipo == 2){
        if(opcion == 1){
            let rowData = tablaDoctores.rows( { selected: true } ).data()[0];
            if(rowData !== undefined){
                $("#id").val(rowData.id_doctor);
                $("#name").val(rowData.doctor);
                $("#specialty option[value="+rowData.id_especialidad+"]").attr('selected','selected');
                $("#div-btn-doctor").html(`<button type="button" class="btn btn-primary btn-block" onclick="editDoctor()">MODIFICAR</button>`);
                $("#modal-registration-doctor").modal('toggle');
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Tiene que escoger un registro",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            
        }else if(opcion == 2){
            let rowData = tablaEspecialidades.rows( { selected: true } ).data()[0];
            console.log(rowData);
            if(rowData !== undefined){
                $("#form-registration-speciality")[0].reset();
                let body = new FormData();
                body.append('option', rowData.id_ubicacion);
                fetch('../ajax/get_location.php',{
                    method: 'POST',
                    body: body,
                })
                .then( response => response.json())
                .then( jsonResponse => {
                    $("#id").val(rowData.id_especialidad);
                    $("#name").val(rowData.especialidad);
                    $("#location").html(jsonResponse.data);
                    $("#location").selectpicker("refresh");
                    $("#location option[value="+rowData.id_ubicacion+"]").attr('selected','selected');
                    $("#modal-registration-speciality").modal('toggle');
                    $("#div-btn-speciality").html(`<button type="button" class="btn btn-primary btn-block" onclick="editSpeciality()">MODIFICAR</button>`);
                    $("#modal-registration-speciality").modal('toggle');
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Tiene que escoger un registro",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            
        }
    }else if(tipo == 3){
        if(opcion == 1){
            let rowData = tablaDoctores.rows( { selected: true } ).data()[0];
            if(rowData !== undefined){
                Swal.fire({
                    title: 'Eliminar registro',
                    text: "Desea eliminar el registro",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3f54f4',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let body = new FormData();
                        body.append('status', 0);
                        body.append('id', rowData.id_doctor);
                        fetch('../ajax/registro_doctor.php', {
                            method: 'POST',
                            body: body,
                        })
                        .then( response => response.json())
                        .then( jsonResponse => {
                            Swal.fire({
                                icon: 'success',
                                title: jsonResponse.msg,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#dt_doctores").DataTable().ajax.reload();
                        })
                    }
                });       
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Tiene que escoger un registro",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }else if(opcion == 2){
            let rowData = tablaEspecialidades.rows( { selected: true } ).data()[0];
            if(rowData !== undefined){
                Swal.fire({
                    title: 'Eliminar registro',
                    text: "Desea eliminar el registro",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3f54f4',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let body = new FormData();
                        body.append('status', 0);
                        body.append('id', rowData.id_especialidad);
                        fetch('../ajax/registro_especialidad.php', {
                            method: 'POST',
                            body: body,
                        })
                        .then( response => response.json())
                        .then( jsonResponse => {
                            Swal.fire({
                                icon: 'success',
                                title: jsonResponse.msg,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#dt_especialidad").DataTable().ajax.reload();
                        })
                    }
                });       
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Tiene que escoger un registro",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
    }else if(tipo == 4){
        if(opcion == 1){
            $("#dt_doctores").DataTable().ajax.reload();
        }else if(opcion == 2){
            $("#dt_especialidad").DataTable().ajax.reload();
        }
        
    }
}