<?php include_once '../template/header.php'; ?>
    <main class="container">
        <h1 class="text-center">Lista de personas</h1>
        <a href="crear-persona.php" class="btn btn-success"><i class="fa fa-duotone fa-user-plus"></i> Crear Persona</a>
        <table id="tblPersonas" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>marca@correo.cl</td>
                    <td>
                        <a href="<?=BASE_URL?>views/persona/editar-persona.php?personaid=1" class="btn btn-outline-primary btn-sm" title="Editar Registro">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <button class="btn btn-outline-danger btn-sm" title="Eliminar registro" onclick="fntDelPersona(1)">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
    <?php include_once '../template/footer.php'; ?>
