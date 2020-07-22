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
	<title>Remenver Pass</title>
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
											<h1 class="card-heading">¿Olvido su clave?</h1>
										</div>
									</div>
									<div class="card-inner">
										<form class="form" name="form-remenver" id="form-remenver"  method="POST" autocomplete="off">
											<div class="form-group form-group-label form-group-alt">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<label class="floating-label" for="remenver-username">Usuario</label>
														<input class="form-control" id="remenver-username" type="password" name="remenver-username" style="text-transform:lowercase;" onKeyUp="this.value = this.value.toLowerCase();" required>
														<span id="mensaje-remenver" class="form-help form-help-msg text-red" style="display:none;">Los datos ingresados no son validos<i class="form-help-icon icon icon-error"></i></span>
													</div>
												</div>
											</div>
											<div class="form-group form-group-alt">
												<div class="row">
													<div class="col-md-10 col-md-push-1">
														<button class="btn btn-block btn-alt waves-button waves-effect waves-light">Enviar Clave</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix">
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
	<script>   
         $(function(){
          $("#form-remenver").submit(function(){
              $.ajax({
         			   type: "POST",
         			   url: "controlador/inicio-sesion/acciones.php?accion=3",
         			   data: $(this).serialize(),
         			   success: function(data)
         			   {
         				   if(data.success)
         				   {	
         						window.location="page-login";
         				   }
         				   else
         				   {
         					   $('#mensaje-remenver').show(30);
         				   }
         			   }
         			});
             return false;
          });
         });
      </script>
</body>
</html>