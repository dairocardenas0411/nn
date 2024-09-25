class usuario {
    constructor(objData) {
        this._objData = objData;
    }

    iniciarSesion() {
        let objDataUsuario = new FormData();
        objDataUsuario.append("emailUsuario", this._objData.email);
        objDataUsuario.append("passwordUsuario", this._objData.password);
        objDataUsuario.append("iniciarSesion", "ok");

        fetch("controlador/usuarioControlador.php", {
            method: 'POST',
            body: objDataUsuario
        })
            .then(response => response.json())
            .catch(error => console.log(error))
            .then(response => {
                if (response.codigo == "200") {
                    window.location = "inicio";
                } else {
                    alert(response.mensaje);
                }
            });
    }

    registrarUsuario() {
        let objData = new FormData();
        objData.append("id_tipo_documento", this._objData.id_tipo_documento);
        objData.append("documento", this._objData.documento);
        objData.append("nombre", this._objData.nombre);
        objData.append("apellido", this._objData.apellido);
        objData.append("email", this._objData.email);
        objData.append("registrarDocente", "ok");

        fetch("controlador/usuarioControlador.php", {
            method: 'POST',
            body: objData
        })
            .then(response => response.json())
            .catch(error => console.log(error))
            .then(response => {
                alert(response.mensaje);
                location.reload();
            });
    }

    listarTipoDocumento() {
        let objDataTipoUsuarios = new FormData();
        objDataTipoUsuarios.append("listaTipoDocumento", "ok");

        fetch("controlador/usuarioControlador.php", {
            method: 'POST',
            body: objDataTipoUsuarios
        })
            .then(response => response.json())
            .catch(error => console.log(error))
            .then(response => {
                if (response.codigo == "200") {
                    const select = document.getElementById(this._objData.idSelect);
                    select.innerHTML = "";
                    let opcion = document.createElement('option');
                    opcion.setAttribute("value", "");
                    opcion.innerHTML = "Seleccione:";
                    select.append(opcion);

                    response.listaTipoUsuarios.forEach(item => {
                        let opcion = document.createElement('option');
                        opcion.setAttribute("value", item.id_tipo_documento);
                        opcion.innerHTML = item.descripcion;
                        select.append(opcion);
                    });
                }
            });
    }
}
