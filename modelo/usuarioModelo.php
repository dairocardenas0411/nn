<?php
include_once "conexion.php";
class usuarioModelo{

    public static function mdlIniciarSesion($email, $password)
    {
        $mensaje = array();

        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM docente  WHERE docente.email=:email AND 
            docente.password=:password");
            $objRespuesta->bindParam(":email", $email);
            $objRespuesta->bindParam(":password", $password);
            $objRespuesta->execute();
            $objUsuario = $objRespuesta->fetch();

            if ($objUsuario != null) {
                $mensaje = array("codigo" => "200", "mensaje" => "ok");
                $_SESSION["usuario"] = $objUsuario["nombre"] . " " . $objUsuario["apellido"];
                $_SESSION["urlImagen"] = $objUsuario["url"];
                $_SESSION["id_docente"] = $objUsuario["id_docente"];
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "El usuario no existe, por favor verifique sus datos.");

            }
            $objRespuesta = null;

        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }
    public static function mdlRegistroModelo($id_tipo_documento,$documento, $nombre, $apellido, $email, $password,
     $url) {
        $mensaje = array();

        $password = $documento;

        $url = "archivos/user-1.jpg"; 

        try {
            $objRespuesta = Conexion::conectar()->prepare(
                "INSERT INTO docente (id_tipo_documento,documento, nombre, apellido, email, password, url) 
                VALUES (:id_tipo_documento,:documento, :nombre, :apellido, :email, :password, :url)"
            );
            $objRespuesta->bindParam(":tipo_documento",$id_tipo_documento);
            $objRespuesta->bindParam(":documento", $documento);
            $objRespuesta->bindParam(":nombre", $nombre);
            $objRespuesta->bindParam(":apellido", $apellido);
            $objRespuesta->bindParam(":email", $email);
            $objRespuesta->bindParam(":password", $password);
            $objRespuesta->bindParam(":url", $url);
            
            
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Usuario registrado correctamente en la base de datos");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar el usuario en la base de datos");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlListaTipoDocumento(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_documento");
            $objRespuesta->execute();
            $listaTipoUsuarios = $objRespuesta->fetchAll();
            $mensaje = array("codigo"=>"200",$listaTipoUsuarios=>id_tipo_documento);
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}