<?php 
   include_once("controlador/inicio-sesion/controlador-sesion.php");
   include_once("modelo/seguridad.class.php");
   $seguridad = new Seguridad();	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title>Perfil</title>
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
		<ul class="nav nav-list pull-left">
			<li>
				<a class="menu-toggle" href="#menu">
					<span class="access-hide">Menu</span>
					<span class="icon icon-menu icon-lg"></span>
					<span class="header-close icon icon-close icon-lg"></span>
				</a>
			</li>
		</ul>
		<a class="header-logo" href="index">DIFCON</a>
		<ul class="nav nav-list pull-right">
			<li>
				<a class="menu-toggle" href="#search">
					<span class="access-hide">Search</span>
					<span class="icon icon-search icon-lg"></span>
					<span class="header-close icon icon-close icon-lg"></span>
				</a>
			</li>
			<li>
				<a class="menu-toggle" href="#profile">
					<?php include_once("menu-toggle-profile.php"); ?>
				</a>
			</li>
		</ul>
	</header>
	<nav class="menu" id="menu">
		<?php include_once("menu.php"); ?>
	</nav>
	<nav class="menu menu-right" id="profile">
		<?php include_once("profile.php"); ?>
	</nav>
	<div class="menu menu-right menu-search" id="search">
		<?php include_once("search.php"); ?>
	</div>
	<div class="content">
		<div class="content-heading">
			<div class="container">
				<h1 class="heading">Perfil</h1>
			</div>
		</div>
		<div class="content-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h2 class="content-sub-heading"><?php echo $_SESSION['DisplayName'] ?></h2>
						<nav class="tab-nav tab-nav-alt">
							<ul class="nav nav-justified">
								<li class="active">
									<a class="waves-effect" data-toggle="tab" href="#first-tab">Informacion basica</a>
								</li>
								<li>
									<a class="waves-effect" data-toggle="tab" href="#second-tab">Estudios</a>
								</li>
								<li>
									<a class="waves-effect" data-toggle="tab" href="#third-tab">Seguridad</a>
								</li>
							</ul>
						</nav>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="first-tab">
								<form class="form" name="form-perfil" id="form-perfil"  method="POST" autocomplete="off">
									<fieldset>
										<div class="form-group form-group-alt">
											<div class="row">
												<div class="col-lg-4 col-md-3 col-sm-4">
													<label class="form-label" for="perfil-name">Nombre</label>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-8">
													<input class="form-control" id="perfil-name" name="perfil-name" placeholder="Nombre" type="text" value="<?php echo $_SESSION['DisplayName'] ?>" required>
												</div>
											</div>
										</div>
										<div class="form-group form-group-alt">
											<div class="row">
												<div class="col-lg-4 col-md-3 col-sm-4">
													<label class="form-label" for="perfil-mail">Correo</label>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-8">
													<input class="form-control" id="perfil-mail" name="perfil-mail" placeholder="info@desinfoxicacion.com" type="text" value="<?php echo $seguridad->Decrypt($_SESSION['Correo']); ?>" required>
												</div>
											</div>
										</div>
										<div class="form-group form-group-alt">
											<div class="row">
												<div class="col-lg-4 col-md-3 col-sm-4">
													<label class="form-label" for="perfil-date">Fecha Nacimiento</label>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-8">
													<input class="form-control" id="perfil-date" name="perfil-date" type="date" value="<?php echo $_SESSION['FechaNacimiento'] ?>" required>
												</div>
											</div>
										</div>
										<div class="form-group form-group-alt">
											<div class="row">
												<div class="col-lg-4 col-md-3 col-sm-4">
													<label class="form-label" for="perfil-perfil">Perfil</label>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-8">
													<select class='form-control' id='perfil-perfil' name='perfil-perfil'>
                                             		</select>
                                             		<span id="mensaje-perfil" class="form-help form-help-msg text-red" style="display:none;">No se pudo actualizar el perfil<i class="form-help-icon icon icon-error"></i></span>
												</div>
											</div>
										</div>
										<div class="form-group form-group-alt">
	                                       <div class="row">
	                                          <div class="col-md-10 col-md-push-1">
	                                             <button class="btn btn-block btn-alt waves-button waves-effect waves-light">Actualizar</button>
	                                          </div>
	                                       </div>
	                                    </div>
									</fieldset>
								</form>
							</div>
							<div class="tab-pane fade" id="second-tab">
								<p>Funcionalidad no implementada.</p>
							</div>
							<div class="tab-pane fade" id="third-tab">
								<form class="form" name="form-pass" id="form-pass"  method="POST" autocomplete="off">
									<fieldset>
										<div class="form-group form-group-alt">
											<div class="row">
												<div class="col-lg-4 col-md-3 col-sm-4">
													<label class="form-label" for="pass-pass1">Nueva Clave</label>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-8">
													<input class="form-control" id="pass-pass1" name="pass-pass1" placeholder="Clave nueva" type="password" required>
												</div>
											</div>
										</div>
										<div class="form-group form-group-alt">
											<div class="row">
												<div class="col-lg-4 col-md-3 col-sm-4">
													<label class="form-label" for="pass-pass2">Repita Nueva Clave</label>
												</div>
												<div class="col-lg-4 col-md-6 col-sm-8">
													<input class="form-control" id="pass-pass2" name="pass-pass2" placeholder="Clave nueva" type="password" required>
													<span id="mensaje-pass" class="form-help form-help-msg text-red" style="display:none;">No se pudo actualizar la clave<i class="form-help-icon icon icon-error"></i></span>
												</div>
											</div>
										</div>
										<div class="form-group form-group-alt">
	                                       <div class="row">
	                                          <div class="col-md-10 col-md-push-1">
	                                             <button class="btn btn-block btn-alt waves-button waves-effect waves-light">Actualizar</button>
	                                          </div>
	                                       </div>
	                                    </div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="container">
			<p>Fundación Universitaria Los Libertadores</p>
		</div>
	</footer>
	<script src="js/base.min.js" type="text/javascript"></script>
	<script>
	    $(function(){
          $('#form-quick-search').submit(function(event){
            $.ajax({
                    type: "POST",
                    url: "controlador/documento/acciones.php?accion=5",
                    data: $("#form-quick-search").serialize(),
                    success: function(data) {
                        $('#menu-search').val('');
                        if (data.success) {
                            $('#form-quick-search-result').empty();
                            $('#form-quick-search-result').html(data.data).fadeIn();
                        }else{
							$('#form-quick-search-result').empty();
						}
                    }
                });
                return false;
            });
         });
		 
		$(document).ready(function() {
                    $.ajax({
                            type: "POST",
                            url: "controlador/perfil/acciones.php?accion=1",
                            success: function(data)
                            {
                              if (data.success) {
                                 $('#perfil-perfil').html(data.data).fadeIn();
                                 $("#perfil-perfil option[value="+ <?php echo $_SESSION['Perfil'] ?> +"]").attr("selected",true);
                              };
                            }
                    });
 
                });
		$(function(){
          $("#form-perfil").submit(function(){
              $.ajax({
         			   type: "POST",
         			   url: "controlador/usuario/acciones.php?accion=2",
         			   data: $(this).serialize(),
         			   success: function(data)
         			   {
         				   if(data.success)
         				   {	
         						location.reload();
         				   }
         				   else
         				   {
         					   $('#mensaje-perfil').show(30);
         				   }
         			   }
         			});
             return false;
          });
          $("#form-pass").submit(function(){
          	if($('#pass-pass1').val()==$('#pass-pass2').val()){
          		$.ajax({
         			   type: "POST",
         			   url: "controlador/inicio-sesion/acciones.php?accion=4",
         			   data: $(this).serialize(),
         			   success: function(data)
         			   {
         				   if(data.success)
         				   {	
							   $('#form-pass')[0].reset();
							   $('#mensaje-pass').hide(30);
         				   }
         				   else
         				   {
         					   $('#mensaje-pass').show(30);
         				   }
         			   }
         			});
          	}
          	else{
          		$('#mensaje-pass').show(30);
          	}
             return false;
          });
         });
	</script>
</body>
</html>