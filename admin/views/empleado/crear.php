<?php require('views/header/header_administrador.php') ?>
<h1><?php if($accion=="crear"):echo('Nuevo');else:echo('Modificar');endif; ?> Empleado</h1>
<form method="post" enctype="multipart/form-data" action="empleado.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id=' . $empleados['id_empleado']);endif;?>">

<div class="mb-3">
        <label for="primer_apellido" class="form-label">Primer apellido del empleado</label>
        <input class="form-control" type="text" name="data[primer_apellido]" placeholder="Escribe aqui el primer apellido" id="primer_apellido"
        value="<?php if(isset($empleados['primer_apellido'])):echo($empleados['primer_apellido']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Segundo apellido del empleado</label>
        <input class="form-control" type="text" name="data[segundo_apellido]" placeholder="Escribe aqui el segundo apellido" id="segundo_apellido"
        value="<?php if(isset($empleados['segundo_apellido'])):echo($empleados['segundo_apellido']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del empleado</label>
        <input class="form-control" type="text" name="data[nombre]" placeholder="Escribe aqui el nombre" id="nombre"
        value="<?php if(isset($empleados['nombre'])):echo($empleados['nombre']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="rfc" class="form-label">RFC del empleado</label>
        <input class="form-control" type="text" name="data[rfc]" placeholder="Escribe aqui el rfc" id="rfc"
        value="<?php if(isset($empleados['rfc'])):echo($empleados['rfc']);endif; ?>"/>
    </div>
    

    <div class="mb-3">
        <label for="">Correo de usuario</label>
        <select name="data[id_usuario]" id="" class="form-select">
            <?php foreach($usuarios as $usuario): ?>
            <?php
                $selected = "";
                if($empleados['id_usuario']==$usuario['id_usuario']){
                    $selected="selected";
                }  
                ?>
            <option value="<?php echo ($usuario['id_usuario']);?>"<?php echo $selected ?>><?php echo($usuario['correo']);?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="mb-3">
        <label for="fotografia" class="form-label">fotografia del empleado</label>
        <input class="form-control" type="file" name="fotografia" placeholder="Escribe aqui el fotografia" id="fotografia"/>
    </div>

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?>