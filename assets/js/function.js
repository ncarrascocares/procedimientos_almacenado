function fntDelPersona(id) {

    swal({
            title: "¿Realmente quieres eliminar el registro?",
            text: "Una vez eliminado no volvera a estar en la lista",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Registro eliminado", {
                    icon: "success",
                });
            } else {
                swal("Se cancelo la acción!");
            }
        });
}