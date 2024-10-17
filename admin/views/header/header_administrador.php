<?php
require_once('views/header.php')
?>
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Administrador</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Catálogos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="invernadero.php">Invernaderos</a>
          <a class="dropdown-item" href="seccion.php">Secciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="login.php?action=logout">Salir</a>
      </li>
    </ul>
  </div>
</nav>