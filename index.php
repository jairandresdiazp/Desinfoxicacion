<?php 
	include_once("controlador/inicio-sesion/controlador-sesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title>Desinfoxicacion</title>
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
	</div>
	<footer class="footer">
		<?php include_once("footer.php"); ?>
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
		 
         $(function(){
          $("#form-register").submit(function(){
              $.ajax({
         			   type: "POST",
         			   url: "controlador/usuario/acciones?accion=1",
         			   data: $(this).serialize(),
         			   success: function(data)
         			   {
         				   if(data.success)
         				   {	
         						window.location="page-login";
         				   }
         				   else
         				   {
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