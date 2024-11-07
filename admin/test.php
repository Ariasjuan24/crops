<?php 
require_once ('../sistema.class.php');
$app = new Sistema;
$roles = $app->getRole('210300149@itcelaya.edu.mx');
print_r($roles);
$privilegios = $app->getPrivilegios('21030149@itcelaya.edu.mx');
print_r($privilegios);
?> 
