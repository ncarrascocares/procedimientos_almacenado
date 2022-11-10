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

        //var_dump($_POST);
       if ($_POST) {
        if (empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['intNumero']) || empty($_POST['txtEmail'])) {
            $arrResponse = array('status' => 'false', 'msg' => 'Error de los datos');
        } else {
            $strNombre = ucwords(trim($_POST['txtNombre']));
            $strApellido = ucwords(trim($_POST['txtApellido']));
            $intTelefono = trim($_POST['intNumero']);
            $strEmail = strtolower($_POST['txtEmail']);

            $arrPersona = $objPersona->insertPersona($strNombre, $strApellido, $intTelefono, $strEmail);
            if ($arrPersona->id > 0) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');
            }else{
                $arrResponse = array('status' => false, 'msg' => 'Error al guardar los datos');
            }
        }

        echo json_encode($arrResponse);
        
       }

       die();
    }


    if ($option == "verregistro") {
        if ($_POST) {
            $idpersona = intval($_POST['idpersona']);
            // print_r($idpersona);
            // die();
            $arrPersona = $objPersona->getPersona($idpersona);

            if (empty($arrPersona)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            }else{
                $arrResponse = array('status' => true, 'msg' => 'Datos encontrados', 'data' => $arrPersona);
            }

            echo json_encode($arrResponse);
        }

        die();

    }


    if ($option == "actualizar") {
        if ($_POST) {
            if (empty($_POST['intId']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['intNumero']) || empty($_POST['txtEmail'])) {
                $arrResponse = array('status' => 'false', 'msg' => 'Error de los datos');
            } else {
                $intId = intval($_POST['intId']);
                $strNombre = ucwords(trim($_POST['txtNombre']));
                $strApellido = ucwords(trim($_POST['txtApellido']));
                $intTelefono = trim($_POST['intNumero']);
                $strEmail = strtolower($_POST['txtEmail']);
    
                $arrPersona = $objPersona->updatePersona($intId,$strNombre, $strApellido, $intTelefono, $strEmail);
                //var_dump($arrPersona);
                //die();
                if ($arrPersona->idp > 0) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al actualizar o correo ya existe');
                }
            }
    
            echo json_encode($arrResponse);
            
           }
    
           die();
    }
    if ($option == "eliminar") {
        echo "Eliminar una persona";
    }

    die();



?>