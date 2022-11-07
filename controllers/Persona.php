<?php

    //Agregando el ficchero del modelo
    require_once "../models/PersonaModel.php";

    $option = $_GET['op'];

    if ($option == "listregistros") {
        
        $objPersona = new PersonaModel();

        $arrPersona = $objPersona->getPersonas();
        print_r("<pre>");
        print_r($arrPersona);
        print_r("</pre>");
        die();


    }
    if ($option == "registro") {
        echo "Registrar Persona";
    }
    if ($option == "verregistro") {
        echo "Ver una personas";
    }
    if ($option == "actualizar") {
        echo "Actualizar una persona";
    }
    if ($option == "eliminar") {
        echo "Eliminar una persona";
    }

    die();



?>