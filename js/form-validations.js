// Wait for the DOM to be ready
$(function() {
    $("form[name='form-registration']").validate({
        // Specify validation rules
        rules: {
            dpi: {
                required: true,
                minlength: 13,
                maxlength: 13,
            },
            name: "required",
            "last-name": "required",
            email: {
                required: true,
                email: true,
                remote: {
                    url: '../ajax/validar_email.php',
                    type: "post",
                    data: {
                      email: function(){ return $('#email').val();}
                  }
                }
            },
            phone: {
                required: true,
                minlength:8,
                maxlength: 8,
            },
            password: {
                required: true,
                minlength: 6
            },
            password2: {
                equalTo: '#password'
            }
        },
        // Specify validation error messages
        messages: {
            dpi:{
                required: "Ingrese su DPI",
                minlength: "Ingrese un DPI valido",
                maxlength: "Ingrese un DPI valido"
            },
            name:{
                required: "Ingrese su nombre",
            },
            "last-name":{
                required: "Ingrese su apellido",
            }, 
            phone: {
                required: "Ingrese su numero de celular",
                minlength: "Escriba un numero de 8 digitos",
                maxlength: "Escriba un numero de 8 digitos"
            },
            password: {
                required: "Escriba su contraseña",
                minlength: "Contraseña debe ser mayor a 6 caracteres"
            },
            password2: "Contraseña no coincide",
            email: {
                required: "Ingrese su correo electronico",
                remote: "¡Correo ya registrado!"
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form, event) {
            event.preventDefault();
            let name = $("#name").val();
            let last_name = $("#last-name").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let dpi = $("#dpi").val();
            let phone = $("#phone").val();
            let birthday = $("#birthday").val();
            let gender = $("#gender option:selected").val();
            let actKey = $("#keyJS").val();
            let actIv = $("#ivJS").val();
            let key = CryptoJS.enc.Hex.parse(actKey);
            let iv = CryptoJS.enc.Hex.parse(actIv);
            let keyJS = key.toString();
            let ivJS = iv.toString();
            let encrypted = CryptoJS.AES.encrypt(password, key, {iv: iv});
            encrypted = encrypted.ciphertext.toString(CryptoJS.enc.Base64);
            $.ajax({
                type: "POST",
                url: "../ajax/registro.php",
                data: { name, last_name, dpi, phone, birthday, gender, email, password, encrypted, keyJS, ivJS},
                dataType: "json",
                success: function (result) {
                    if(result.status == "200"){
                        $("#form-registration")[0].reset();
                        $("#modal-registration").modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro exitoso!',
                            text: 'Ya puedes iniciar sesión',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "../catalagos";
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function (jqXHR, exception) {
                    let msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                }
            });
        }
    });    

    $("form[name='form-login']").validate({
        rules: {
            "email-login": {
                required: true,
            },
            "password-login": {
                required: true,
            }
        },
        // Specify validation error messages
        messages: {
            "email-login": "Ingrese su correo electronico",
            "password-login": {
                required: "Escriba su contraseña",
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form, event) {
            event.preventDefault();
            let email = $("#email-login").val();
            let password = $("#password-login").val();
            let actKey = $("#keyJS").val();
            let actIv = $("#ivJS").val();
            let key = CryptoJS.enc.Hex.parse(actKey);
            let iv = CryptoJS.enc.Hex.parse(actIv);
            let keyJS = key.toString();
            let ivJS = iv.toString();
            let encrypted = CryptoJS.AES.encrypt(password, key, {iv: iv});
            encrypted = encrypted.ciphertext.toString(CryptoJS.enc.Base64);
            $.ajax({
                type: "POST",
                url: "../ajax/login.php",
                data: { email, encrypted, keyJS, ivJS},
                dataType: "json",
                success: function (result) {
                    $("#form-login")[0].reset();
                    if(result.status == "200"){
                        $("#form-login")[0].reset();
                        $("#modal-login").modal('hide');
                        dataLayer.push({'event':'iniciodesesion'});
                        location.reload();
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    
                },
                error: function (jqXHR, exception) {
                    let msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                }
            });
        }
    });

    $("form[name='form-registration-doctor']").validate({
        rules: {
            name: "required",
        },
        messages: {
            name:{
                required: "Ingrese su nombre",
            },
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let id = $("#id").val();
            let name = $("#name").val();
            let specialty = $("#specialty option:selected").val();
            $.ajax({
                type: "POST",
                url: "../ajax/registro_doctor.php",
                data: { id, name, specialty, status: 1},
                dataType: "json",
                success: function (result) {
                    if(result.status == "200"){
                        $("#form-registration-doctor")[0].reset();
                        $("#modal-registration-doctor").modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    $("#dt_doctores").DataTable().ajax.reload();
                },
                error: function (jqXHR, exception) {
                    let msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                }
            });
        }
    });

    $("form[name='form-registration-cita']").validate({
        // Specify validation rules
        rules: {
            date: "required",
        },
        // Specify validation error messages
        messages: {
            date:{
                required: "Ingrese la fecha y hora de la cita",
            },
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form, event) {
            event.preventDefault();
            let medico = $("#medicos-list option:selected").val();
            let fecha = $("#dtp_input1").val();
            $.ajax({
                type: "POST",
                url: "../ajax/registro_cita.php",
                data: { medico, fecha},
                dataType: "json",
                success: function (result) {
                    console.log('llego a exito');
                    if(result.status == "200"){
                        $("#form-registration-cita")[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro exitoso!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function (jqXHR, exception) {
                    let msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                }
            });
        }
    });

    $("form[name='form-registration-speciality']").validate({
        rules: {
            name: "required",
        },
        messages: {
            name:{
                required: "Ingrese el nombre de la especialidad",
            },
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let id = $("#id").val();
            let name = $("#name").val();
            let location = $("#location option:selected").val();
            $.ajax({
                type: "POST",
                url: "../ajax/registro_especialidad.php",
                data: { id, name, location, status: 1},
                dataType: "json",
                success: function (result) {
                    if(result.status == "200"){
                        $("#form-registration-speciality")[0].reset();
                        $("#modal-registration-speciality").modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    $("#dt_especialidad").DataTable().ajax.reload();
                },
                error: function (jqXHR, exception) {
                    let msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                }
            });
        }
    });
});

function onKeyDownHandler(event, value, length) {
    let codigo = event.which || event.keyCode;
    return ((codigo === 9) || (codigo === 8) || (codigo === 37) || (codigo === 39) || ( (codigo >= 48 && codigo <= 57)) && (value.length < length));
}

