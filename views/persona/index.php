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
            <tbody id="tblBodyPersonas">
                <!--Esta sección se llena desde el fichero functions-personas.js-->
            </tbody>
        </table>
    </main>
    <?php include_once '../template/footer.php'; ?>
<script src="../template/js/funtions-persona.js"></script>