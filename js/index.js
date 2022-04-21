let tablaDoctores, tablaEspecialidades;


function open_modal(opcion){
    if(opcion == 1){
        $("#modal-registration").modal('toggle');
    }else if(opcion == 2){
        $("#modal-login").modal('toggle');
    }else if(opcion == 3){
        $("#modal-registration-doctor").modal('toggle');
    }
}

$("#btn-register").on("click",function(){
    if($("#form-registration").valid()){
        $("#form-registration").submit();
    }
});

$("#btn-login-form").on("click",function(){
    if($("#form-login").valid()){
        $("#form-login").submit();
    }
});

function saveDoctor(){
    if($("#form-registration-doctor").valid()){
        $("#form-registration-doctor").submit();
    }
}

function editDoctor(){
    if($("#form-registration-doctor").valid()){
        $("#form-registration-doctor").submit();
    }
}

function saveSpeciality(){
    if($("#form-registration-speciality").valid()){
        $("#form-registration-speciality").submit();
    }
}

function editSpeciality(){
    if($("#form-registration-speciality").valid()){
        $("#form-registration-speciality").submit();
    }
}

function changeMunicipio(id_departamento){
    let body = new FormData();
    body.append('opcion', 2);
    body.append('id_departamento', id_departamento);
    fetch('../ajax/get_data_location.php',{
        method: 'POST',
        body: body,
    })
    .then( response => response.json())
    .then( jsonResponse => {
        $("#municipio").html(jsonResponse.data);
        $("#municipio").selectpicker("refresh");
    });
}

$("#btn-register-cita").on("click",function(){
    if($("#form-registration-cita").valid()){
        $("#form-registration-cita").submit();
    }
});