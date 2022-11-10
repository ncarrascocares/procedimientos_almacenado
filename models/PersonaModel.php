<?php
require_once "../libraries/conexion.php";

    class PersonaModel{
        //
        private $conexion;
        function __construct()
        {   
            //Instancia de la clase Conexion
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function getPersonas(){
            $arrRegistros = array();
            $rs = $this->conexion->query("CALL select_persona()");

            while( $obj = $rs->fetch_object()){
                    array_push($arrRegistros, $obj);
            }

            return $arrRegistros;
        }

        public function insertPersona(string $nombre, string $apellido, int $telefono, string $email){
            $sql = $this->conexion->query("CALL insert_personas('{$nombre}', '{$apellido}', '{$telefono}', '{$email}')");
            $respuesta = $sql->fetch_object();
            return $respuesta;
        }
    }

  

?>