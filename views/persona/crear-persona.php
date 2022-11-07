<?php include_once '../template/header.php'; ?>
<main class="container">
    <h1 class="text-center">Crear personas</h1>
    <a href="<?= BASE_URL ?>views/persona/index.php" class="btn btn-success"><i class="fa-solid fa-list"></i> Listar Personas</a>
    <br><br>
    <form id="frmRegistro">
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
            <input type="password" class="form-control" id="txtEmail" name="txtEmail" placeholder="Correo electronico" requerid> 
        </div>
        <button type="submit" class="btn btn-info"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
    </form>
</main>
<?php include_once '../template/footer.php'; ?>