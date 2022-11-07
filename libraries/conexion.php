<?php
    require_once "../config/config.php";

    //Clase conexión para utilizar en los demas ficheros la conexion a la bd
    class Conexion{
        public static function conect(){
            $mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $mysql->set_charset(DB_CHARSET);

            if (mysqli_connect_errno()) {
                echo "Error en la conexión: ".mysqli_connect_errno();
            }
            return $mysql;

        }
    }


?>