<?php include_once '../template/header.php'; ?>
<main class="container">
    <h1 class="text-center">Editar persona</h1>
    <a href="<?= BASE_URL ?>views/persona/index.php" class="btn btn-success"><i class="fa-solid fa-list"></i> Volver al listado</a>
    <br><br>
    <form id="frmEditar">
        <input type="hidden" id="intId" name="intId">
        <div class="mb-3">
            <label for="txtNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" required>
        </div>
        <div class="mb-3">
            <label for="txtApellido" class="form-label">Apelido</label>
            <input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" requerid> 
        </div>
        <div class="mb-3">
            <label for="intNumero" class="form-label">Telefono</label>
            <input type="number" class="form-control" id="intNumero" name="intNumero" placeholder="Número celular" requerid> 
        </div>
        <div class="mb-3">
            <label for="txtEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Correo electronico" requerid> 
        </div>
        <button type="submit" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
    </form>
</main>
<?php include_once '../template/footer.php'; ?>
<script src="../template/js/funtions-persona.js"></script>
<script>

    let id = "<?= $_GET['p'] ?>";
    fntMostar(id);

</script>