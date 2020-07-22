<?php
   include_once("controlador/inicio-sesion/controlador-sesion.php");
   include_once("modelo/seguridad.class.php");
   $seguridad = new Seguridad();
?>
<div class="menu-scroll">
   <div class="menu-wrap">
      <div class="menu-top">
         <div class="menu-top-info">
            <form id="form-quick-search" id="form-quick-search" class="form-group-alt menu-top-form" autocomplete="off">
               <label class="access-hide" for="menu-search">Buscar</label>
               <input class="form-control form-control-inverse menu-search-focus" id="menu-search" name="menu-search" placeholder="Buscar" type="text" required>
               <button class="access-hide" type="button" onclick="quicksearch()">Buscar</button>
            </form>
         </div>
      </div>
      <div class="menu-content">
         <div class="menu-content-inner" id="form-quick-search-result">
         </div>
      </div>
   </div>
</div>
<?php ?>