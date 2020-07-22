<?php
   include_once("controlador/inicio-sesion/controlador-sesion.php");
   include_once("modelo/seguridad.class.php");
   $seguridad = new Seguridad();
?>
<div class="menu-scroll">
   <div class="menu-wrap">
      <div class="menu-top">
         <div class="menu-top-info">
            <a class="menu-top-user" href="page-perfil"><span class="avatar pull-left"><img src="images/users/avatar-001.jpg"></span><?php echo $_SESSION['DisplayName'] ?></a>
         </div>
      </div>
      <div class="menu-content">
         <ul class="nav">
            <li>
               <a href="page-perfil"><span class="icon icon-account-box"></span>Configuracion</a>
            </li>
            <li>
               <a href="controlador/inicio-sesion/acciones.php?accion=2"><span class="icon icon-exit-to-app"></span>Salir</a>
            </li>
         </ul>
      </div>
   </div>
</div>
<?php ?>