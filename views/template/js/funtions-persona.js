async function getPersona() {
    try {

        let resp = await fetch(base_url + "controllers/Persona.php?op=listregistros");
        json = await resp.json();
        if (json.status) {
            let data = json.data;
            data.forEach((item) => {
                let newtr = document.createElement("tr");
                newtr.id = "row_" + item.idpersona;
                newtr.innerHTML = `<tr>
                                    <th scope="row">${item.idpersona}</th>
                                        <td>${item.nombre}</td>
                                        <td>${item.apellido}</td>
                                        <td>${item.telefono}</td>
                                        <td>${item.email}</td>
                                        <td>${item.options}</>
                                    <tr/>`;

                document.querySelector("#tblBodyPersonas").appendChild(newtr);
            });
        }
        console.log(json);


    } catch (error) {
        console.log("Ocurrio un error: " + error);
    }
}

//Con esta validación evitamos que al imbocar este fichero y no exista #tblBodyPersonas arroja un error
if (document.querySelector("#tblBodyPersonas")) {
    getPersona();
}

/*
validando que exista el selector del formulario de guardar, el cual se ubica en el fichero crear-persona.php
Si existe el selector crear la variable
*/
if (document.querySelector("#frmRegistro")) {
    /*Toda la información del formulario se guarda en la variable frmRegistro */
    let frmRegistro = document.querySelector("#frmRegistro");

    /*Se agrega el evento al presionar el boton del formulario del fichero crear-persona.php*/
    frmRegistro.onsubmit = function(e) {
        e.preventDefault();

        /* ejecutando la función */
        fntGuardar();
    }

    async function fntGuardar() {
        let strNombre = document.querySelector("#txtNombre").value;
        let strApellido = document.querySelector("#txtApellido").value;
        let strNumero = document.querySelector("#intNumero").value;
        let strEmail = document.querySelector("#txtEmail").value;

        /*
     Validando los valores que se recogierón del formulario, en el caso de haber uno vacio
     ingresa al if, enviara el mensaje y ejecuta el return
     */
        if (strNombre == "" || strApellido == "" || strNumero == "" || strEmail == "") {
            alert("Todos los campos son obligatorios");
            return;
        }

        try {
            const data = new FormData(frmRegistro);
            let resp = await fetch(base_url + "controllers/Persona.php?op=registro", {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: data
            });

            json = await resp.json();
            if (json.status) {
                swal("Guardar", json.msg, "success");
                frmRegistro.reset();
            } else {
                swal("Error", json.msg, "error");
            }
        } catch (error) {
            console.log("error" + error);
        }
    }


}

async function fntMostar(id) {
    //Objeto de FormData
    let formData = new FormData();
    formData.append('idpersona', id);

    try {
        let resp = await fetch(base_url + "controllers/Persona.php?op=verregistro", {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if (json.status) {
            document.querySelector('#intId').value = json.data.idpersona;
            document.querySelector('#txtNombre').value = json.data.nombre;
            document.querySelector('#txtApellido').value = json.data.apellido;
            document.querySelector('#intNumero').value = json.data.telefono;
            document.querySelector('#txtEmail').value = json.data.email;
        } else {
            window.location = base_url + 'views/persona/';
        }
        console.log(resp);

    } catch (error) {
        console.log("error" + error);
    }
}

if (document.querySelector("#frmEditar")) {
    /*Toda la información del formulario se guarda en la variable frmRegistro */
    let frmEditar = document.querySelector("#frmEditar");

    /*Se agrega el evento al presionar el boton del formulario del fichero crear-persona.php*/
    frmEditar.onsubmit = function(e) {
        e.preventDefault();

        /* ejecutando la función */
        fntEditar();
    }

    async function fntEditar() {
        let intId = document.querySelector("#intId").value;
        let strNombre = document.querySelector("#txtNombre").value;
        let strApellido = document.querySelector("#txtApellido").value;
        let strNumero = document.querySelector("#intNumero").value;
        let strEmail = document.querySelector("#txtEmail").value;

        /*
     Validando los valores que se recogierón del formulario, en el caso de haber uno vacio
     ingresa al if, enviara el mensaje y ejecuta el return
     */
        if (intId == "" || strNombre == "" || strApellido == "" || strNumero == "" || strEmail == "") {
            alert("Todos los campos son obligatorios");
            return;
        }

        try {
            const data = new FormData(frmEditar);
            let resp = await fetch(base_url + "controllers/Persona.php?op=actualizar", {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: data
            });

            json = await resp.json();
            if (json.status) {
                swal("Actualizar", json.msg, "success");
                window.location = base_url + 'views/persona/';
            } else {
                swal("Actualizar", json.msg, "error");
            }
        } catch (error) {
            console.log("error" + error);
        }
    }


}