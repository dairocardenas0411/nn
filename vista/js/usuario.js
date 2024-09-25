(function () {

    const btnRegistro = document.getElementById('btnModalDocente');
    btnRegistro.addEventListener("click", () => {
        let objData = { "listarTipoDocumento": "ok", "idSelect": "select_id_tipo_documento" }
        let objTipoUsuarios = new listarTipoDocumento(objData);
        objTipoUsuarios.listarTipoDocumento();

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('#formRegistroDocentes')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault()

                        if (!form.checkValidity()) {
                            event.stopPropagation()
                            form.classList.add('was-validated')
                        } else {
                            let id_tipo_documento = document.getElementById('select_id_tipo_documento').value;
                            let documento = document.getElementById('txt_documento').value;
                            let nombres = document.getElementById('txt_nombres').value;
                            let apellidos = document.getElementById('txt_apellidos').value;
                            let email = document.getElementById('txt_email').value;
                            // let tipoUsuario = document.getElementById('selectTipoUsuario').value;
                            let objData = { "registrarUsuario": "ok", "id_tipo_documento": id_tipo_documento, "documento": documento, "nombre": nombres, "apellido": apellidos, "email": email };
                            let objRegistrUsuario = new usuario(objData);
                            objRegistrUsuario.registrarUsuario();
                        }

                    }, false)
                })
        })()
    })
})();