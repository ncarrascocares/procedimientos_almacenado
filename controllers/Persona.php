<?php

    //Agregando el ficchero del modelo
    require_once "../models/PersonaModel.php";
    $option = $_REQUEST['op'];
    #Instanciando a la clase PersonaModel
    $objPersona = new PersonaModel();

    if ($option == "listregistros") {

        $arrResponse = array('status' => false, 'data'=>"");
        #En esta linea se esta imbocando al metodo getPersona de la clase PerosnaModel, mediante la instancia
        $arrPersona = $objPersona->getPersonas();
        
        if (!empty($arrPersona)) {

            for ($i=0; $i < count($arrPersona); $i++) {
                $idpersona = $arrPersona[$i]->idpersona;
                $options = '
                <a href="'.BASE_URL.'views/persona/editar-persona.php?p='.$idpersona.'" class="btn btn-outline-primary btn-sm" title="Editar Registro">
                    <i class="fas fa-user-edit"></i>
                </a>
                <button class="btn btn-outline-danger btn-sm" title="Eliminar registro" onclick="fntDelPersona('.$idpersona.')">
                    <i class="fas fa-trash-alt"></i>
                </button>';
                $arrPersona[$i]->options = $options;
            }
            $arrResponse['status'] = true;
            $arrResponse['data'] = $arrPersona;
        }

        echo json_encode($arrResponse);

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