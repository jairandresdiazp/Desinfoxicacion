<?php
   include_once("controlador/inicio-sesion/controlador-sesion.php");
   include_once("modelo/seguridad.class.php");
   $seguridad = new Seguridad();
?>
<span class="access-hide"><?php echo $_SESSION['DisplayName'] ?></span>
<span class="avatar avatar-sm"><img src="images/users/avatar-001.jpg"></span>
<span class="header-close icon icon-close icon-lg"></span>
<?php ?>