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
    <title>Documents</title>
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
                <h1 class="heading">Documentos</h1>
            </div>
        </div>
        <div class="content-inner">
            <div class="container">
                <form class="form" name="form-add-documents" id="form-add-documents" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <fieldset>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-name">Nombre</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <input class="form-control" id="add-document--name" name="add-document-name" placeholder="Nombre del Documento" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-autor">Autores</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <textarea class="form-control textarea-autosize" id="add-document-autor" name="add-document-autor" placeholder="Autores Separados por ," rows="1" style="height: 35px;" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-palabras-clave">Palabras Clave</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <textarea class="form-control textarea-autosize" id="add-document-palabras-clave" name="add-document-palabras-clave" placeholder="Palabras Clave Separadas por ," rows="1" style="height: 35px;" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-url">URL</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <input class="form-control" id="add-document-url" name="add-document-url" placeholder="https://www.google.com" type="URL" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-ruta">Ruta</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <input class="form-control" id="add-document-ruta" name="add-document-ruta" type="file" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-date">Año Pulbicacion</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <input class="form-control" id="add-document-date" name="add-document-date" placeholder="<?php echo date ("Y"); ?>" type="number" max="9999" min ="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-lg-4 col-md-3 col-sm-4">
                                    <label class="form-label" for="add-document-tipo">Tipo Documento</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <select class='form-control' id='add-document-tipo' name='add-document-tipo' required>
                                    </select>
                                    <span id="add-document-mensaje" class="form-help form-help-msg text-red" style="display:none;">No se pudo cargar el documento<i class="form-help-icon icon icon-error"></i></span>
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
                                    <button class="btn btn-block btn-alt waves-button waves-effect waves-light">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <?php include_once("footer.php"); ?>
    </footer>
    <script src="js/base.min.js" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
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
                url: "controlador/tipodocumento/acciones.php?accion=1",
                success: function(data) {
                    if (data.success) {
                        $('#add-document-tipo').html(data.data).fadeIn();
                    }
                }
            });
        });
        $(function(){
          $("#form-add-documents").submit(function(){
               var inputFileImage = document.getElementById("add-document-ruta");
			   var file = inputFileImage.files[0];
			   var data = new FormData($("#form-add-documents"));;
			   data.append('add-document-ruta',file);
              $.ajax({
         			   type: "POST",
         			   url: "controlador/documento/acciones.php?accion=1&"+$(this).serialize(),
         			   contentType: false,
         			   data: data,
         			   processData:false,
         			   cache:false,
         			   success: function(data)
                        {
         				   if(data.success)
         				   {	
         						location.reload();
         				   }
         				   else
         				   {
                                grecaptcha.reset();
                                $('#add-document-mensaje').html(data.description+"<i class='form-help-icon icon icon-error'></i>").fadeIn();
                                $('#add-document-mensaje').show(30);
         				   }         			   
                        }
         			});
             return false;
          });
         });
    </script>
</body>
</html>