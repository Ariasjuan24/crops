<?php require('views/header/header_administrador.php'); ?>
<h1><?php echo ($accion == "crear") ? "Nuevo " : "Modificar "; ?>Permiso</h1>

<form action="permisos.php?accion=<?php echo ($accion == "crear") ? 'nuevo' : 'modificar&id=' . $id; ?>" method="post">
    <div class="row mb-3">
        <label for="permiso" class="col-sm-2 col-form-label">Nombre del Permiso</label>
        <div class="col-sm-10">
            <input type="text" name="data[permiso]" placeholder="Escribe aquí el nombre del permiso" class="form-control" 
                   value="<?php echo isset($permiso['permiso']) ? $permiso['permiso'] : ''; ?>" required/>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php'); ?>