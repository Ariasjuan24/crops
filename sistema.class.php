<?php
    session_start();
    require_once('config.class.php');
    class sistema {
        var $con;
        function conexion(){
            $this -> con = new PDO(SGBD.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT, DBUSER, DBPASS);
        }
        
        function alerta($tipo, $mensaje) {
            include('views/alert.php');
        }

        function getRole($correo) {
            $this -> conexion();
            $data = [];
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $sql = "select r.rol from usuario u inner join usuario_rol ur on u.id_usuario = ur.id_usuario
                    inner JOIN rol r on r.id_rol = ur.id_rol
                    where u.correo = :correo ";

                $roles = $this->con->prepare($sql);
                $roles->bindParam(":correo",$correo,PDO::PARAM_STR);
                $roles->execute();
                $data = $roles->fetchAll(PDO::FETCH_ASSOC);
                $roles = [];
                foreach($data as $rol) {
                  array_push($roles, $rol['rol']);
                }
                $data = $roles;
            }
            
            return $data;
        }

        function getPrivilegios($correo) {
            $this -> conexion();
            $data = [];
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $sql = "select p.permiso from usuario u inner join usuario_rol ur on u.id_usuario = ur.id_usuario
                        inner JOIN rol r on r.id_rol = ur.id_rol
                        INNER JOIN rol_permiso rp on rp.id_rol = r.id_rol
                        inner JOIN permiso p on p.id_permiso = rp.id_permiso
                            where u.correo = :correo;";

                $privilegio = $this->con->prepare($sql);
                $privilegio->bindParam(":correo",$correo,PDO::PARAM_STR);
                $privilegio->execute();
                $data = $privilegio->fetchAll(PDO::FETCH_ASSOC);
                $permisos = [];
                foreach($data as $permiso) {
                  array_push($permisos, $permiso['permiso']);
                }
                $data = $permisos;
            }
            
            return $data;
        }

        function login($correo, $contrasena) {
          $contrasena = md5($contrasena);
          $acceso = false;

          if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this -> conexion();
            $sql = "select * from usuario where correo = :correo and contrasena = :contrasena;";
            $sql = $this->con->prepare($sql);
            $sql->bindParam(":correo",$correo,PDO::PARAM_STR);
            $sql->bindParam(":contrasena",$contrasena,PDO::PARAM_STR);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

            if (isset($resultado[0])) {
              $acceso = true;
              $_SESSION['correo'] = $correo;
              $_SESSION['validado'] = $acceso;
              $roles = $this -> getRole($correo);
              $privilegios = $this -> getPrivilegios($correo);

              $_SESSION['roles'] = $roles;
              $_SESSION['privilegios'] = $privilegios;

              return $acceso;
            }
          }

          $_SESSION['validado'] = false;
          return $acceso;
        }

        function logout() {
          unset($_SESSION);
          session_destroy();
          $mensaje = "Gracias por utilizar el sistema, se ha cerrado la sesion 
          <a href='login.php'>[Presione aquí para volver a entrar]</a>";
          $tipo = "success";
          require_once('views/header.php');
          $this->alerta($tipo, $mensaje);
          require_once('views/footer.php');
        }

        function checkRole($rol) {
          $roles = $_SESSION['roles'];
          if (!in_array($rol, $roles)) {
            $mensaje = "Eror, usted no tiene el rol adecuado";
            $tipo = "danger";
            require_once('views/header/alert.php');
            $this->alerta($tipo, $mensaje);
            die();
          } else {
          }
        }
    }
?>