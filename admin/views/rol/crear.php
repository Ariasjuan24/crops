<?php require('views/header/header_administrador.php') ?>

<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo('Modificar'); endif; ?> Roles</h1>
<form method="post" action="rol.php?accion=<?php if($accion == "crear"): echo('nuevo'); else: echo('modificar&id=' . $roles['id_rol']); endif; ?>">

    <div class="mb-3">
        <label for="rol" class="form-label">Nombre del rol</label>
        <input class="form-control" id="rol" type="text" name="data[rol]" placeholder="Escribe aquí el rol" 
        value="<?php if(isset($roles['rol'])): echo($roles['rol']); endif; ?>" required/>
    </div>

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>

</form>

<?php require('views/footer.php'); ?>
