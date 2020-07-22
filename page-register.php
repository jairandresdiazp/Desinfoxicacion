<?php 
   error_reporting(0);
   session_start();
   if(isset($_SESSION['IdUsuario']))
   {
   	header('Location: index');
   }
   ?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta content="IE=edge" http-equiv="X-UA-Compatible">
      <meta content="initial-scale=1.0, width=device-width" name="viewport">
      <title>Register</title>
      <link href="favicon.ico" rel="icon" type="image/x-icon" />
      <!-- css -->
      <link href="css/base.min.css" rel="stylesheet">
      <!-- favicon -->
      <!-- ... -->
      <!-- ie -->
      <!--[if lt IE 9]>
      <script src="js/html5shiv.js" type="text/javascript"></script>
      <script src="js/respond.js" type="text/javascript"></script>
      <![endif]-->
   </head>
   <body class="avoid-fout">
      <div class="avoid-fout-indicator avoid-fout-indicator-fixed">
         <div class="progress-circular progress-circular-alt progress-circular-center">
            <div class="progress-circular-wrapper">
               <div class="progress-circular-inner">
                  <div class="progress-circular-left">
                     <div class="progress-circular-spinner"></div>
                  </div>
                  <div class="progress-circular-gap"></div>
                  <div class="progress-circular-right">
                     <div class="progress-circular-spinner"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <header class="header">
         <span class="header-logo">DIFCON</span>
      </header>
      <div class="content">
         <div class="content-heading">
         </div>
         <div class="content-inner">
            <div class="container">
               <div class="row">
                  <div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3">
                     <div class="card-wrap">
                        <div class="card">
                           <div class="card-main">
                              <div class="card-header">
                                 <div class="card-inner">
                                    <h1 class="card-heading">Cree una cuenta para iniciar en Desinfoxicacion</h1>
                                 </div>
                              </div>
                              <div class="card-inner">
                                 <form class="form" name="form-register" id="form-register"  method="POST" autocomplete="off">
                                    <div class="form-group form-group-label form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="floating-label" for="register-name">Nombre</label>
                                             <input class="form-control" id="register-name" type="text" name="register-name" required>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-label form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="floating-label" for="register-mail">Correo</label>
                                             <input class="form-control" id="register-mail" type="email" name="register-mail" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="form-label" style="text-align: left;" for="register-date">Fecha Nacimiento</label>
                                             <input class="form-control" id="register-date" name="register-date" type="date" required>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-label form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="floating-label" for="register-username">Usuario</label>
                                             <input class="form-control" id="register-username" type="text" name="register-username" style="text-transform:lowercase;" onKeyUp="this.value = this.value.toLowerCase();" required>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-label form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="floating-label" for="register-password">Clave</label>
                                             <input class="form-control" id="register-password" type="password" name="register-password" required>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-label form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="floating-label" for="register-perfil">Perfil</label>
                                             <select class='form-control' id='register-perfil' name='register-perfil'>
                                             </select>
                                             <span id="mensaje-register" class="form-help form-help-msg text-red" style="display:none;">No se pudo registrar el usuario<i class="form-help-icon icon icon-error"></i></span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <div align="center" class="g-recaptcha" data-sitekey="6LemxwoUAAAAAEX7bW2383cH7gGjpgp74xQjw5TE"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <button class="btn btn-block btn-alt waves-button waves-effect waves-light">Crear</button>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix">
                        <p class="margin-no-top pull-left"><a href="page-remenver-pass">Olvido su clave?</a></p>
                        <p class="margin-no-top pull-right"><a href="page-login">Iniciar sesion</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <footer class="footer">
         <?php include_once("footer.php"); ?>
      </footer>
      <script src="js/base.min.js" type="text/javascript"></script>
      <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
      <script>
         $(document).ready(function() {
                    $.ajax({
                            type: "POST",
                            url: "controlador/perfil/acciones.php?accion=1",
                            success: function(data)
                            {
                              if (data.success) {
                                 $('#register-perfil').html(data.data).fadeIn();
                              };
                            }
                    });
 
                });
         $(function(){
          $("#form-register").submit(function(){
              $.ajax({
         			   type: "POST",
         			   url: "controlador/usuario/acciones.php?accion=1",
         			   data: $(this).serialize(),
         			   success: function(data)
         			   {
         				   if(data.success)
         				   {
                      window.location="page-login";
         				   }
         				   else
         				   {
                      grecaptcha.reset();
                      $('#mensaje-register').html(data.description+"<i class='form-help-icon icon icon-error'></i>").fadeIn();
                      $('#mensaje-register').show(30);
         				   }
         			   }
         			});
             return false;
          });
         });
      </script>
   </body>
</html>