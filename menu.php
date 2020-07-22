<?php
   include_once("controlador/inicio-sesion/controlador-sesion.php");
   include_once("modelo/seguridad.class.php");
   $seguridad = new Seguridad();
?>
<div class="menu-scroll">
   <div class="menu-wrap">
      <div class="menu-content">
         <ul class="nav">
            <li>
               <a>Documentos</a>
               <span class="menu-collapse-toggle collapsed" data-target="#form-elements" data-toggle="collapse"><i class="icon icon-close menu-collapse-toggle-close"></i><i class="icon icon-add menu-collapse-toggle-default"></i></span>
               <ul class="menu-collapse collapse" id="form-elements">
                  <li>
                     <a href="page-add-documents">Agregar</a>
                     <a href="page-get-documents">Buscar</a>
                  </li>
               </ul>
            </li>
            <hr>
            <li>
               <a href="page-get-documents-self">Mis Documentos</a>
            </li>
            <hr>
         </ul>
      </div>
   </div>
</div>
<?php ?>