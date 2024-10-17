<?php require('views/header/header_administrador.php') ?>
<h1><?php if($accion=="crear"):echo('Nueva');else:echo('Modificar');endif; ?> Seccion</h1>
<form method="post" action="seccion.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id=' . $secciones['id_seccion']);endif;?>">
    <div class="mb-3">
        <label for="seccion" class="form-label">Nombre de la Seccion</label>
        <input class="form-control" type="text" name="data[seccion]" placeholder="Escribe aqui el nombre" id="seccion"
        value="<?php if(isset($secciones['seccion'])):echo($secciones['seccion']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="area" class="form-label">Area de la Seccion (m<sup>2</sup>)</label>
        <input class="form-control" id="area" type="number" name="data[area]" placeholder="Escribe aqui el area" 
        value="<?php if(isset($secciones['area'])):echo($secciones['area']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="">Invernadero</label>
        <select name="data[id_invernadero]" id="" class="form-select">
            <?php foreach($invernaderos as $invernadero): ?>
            <?php
                $selected = "";
                if($secciones['id_invernadero']==$invernadero['id_invernadero']){
                    $selected="selected";
                }  
                ?>
            <option value="<?php echo ($invernadero['id_invernadero']);?>"<?php echo $selected ?>><?php echo($invernadero['invernadero']);?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?>