<?php
session_start();

include_once "../modelo/usuarioModelo.php";


class usuarioControlador {
    public $id_docente;
    public $documento;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $url;
    public $id_tipo_documento;
    public $descripcion;


    public function ctrIniciarSesion() {
        $objRespuesta = usuarioModelo::mdlIniciarSesion($this->email, $this->password);
        echo json_encode($objRespuesta);
    }
    
    

    public function ctrListaTipoDocumento(){
        $objRespuesta = usuarioModelo:: mdlListaTipoDocumento();
        echo json_encode($objRespuesta);
    }
}



if (isset($_POST["iniciarSesion"]) == "ok") {
    $objUsuario = new usuarioControlador();
    $objUsuario->email = $_POST["emailUsuario"];
    $objUsuario->password = $_POST["passwordUsuario"];
    $objUsuario->ctrIniciarSesion();
}
if (isset($_POST["registrarUsuario"])== "ok") {
    $objUsuario = new usuarioControlador();
    $objUsuario->tipodocumento=$_POST["id_tipo_documento"];
    $objUsuario->documento = $_POST["documento"];
    $objUsuario->nombre = $_POST["nombre"];
    $objUsuario->apellido = $_POST["apellido"];
    $objUsuario->email = $_POST["email"];
 
    $objUsuario->ctrRegistrarUsuario();
}
if(isset($_POST["listaTipoDocumento"]) == "ok"){
    $objTipoUsuario = new usuarioControlador();
    $objTipoUsuario ->ctrListaTipoDocumento();
}