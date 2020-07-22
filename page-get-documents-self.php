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
                    <?php include_once( "menu-toggle-profile.php"); ?>
                </a>
            </li>
        </ul>
    </header>
    <nav class="menu" id="menu">
        <?php include_once( "menu.php"); ?>
    </nav>
    <nav class="menu menu-right" id="profile">
        <?php include_once( "profile.php"); ?>
    </nav>
    <div class="menu menu-right menu-search" id="search">
        <?php include_once( "search.php"); ?>
    </div>
    <div class="content">
        <div class="content-heading">
            <div class="container">
                <h1 class="heading">Mis Documentos</h1>
            </div>
        </div>
        <div class="content-inner">
            <div class="container" style="display:none;">
                <form class="form" name="form-get-documents" id="form-get-documents" method="POST" autocomplete="off">
                    <fieldset>
                        <div class="form-group form-group-label form-group-green">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="floating-label" for="get-document-name">Nombre</label>
                                    <input class="form-control" id="get-document--name" name="get-document-name" placeholder="Nombre del Documento" type="text">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="floating-label" for="get-document-autor">Autores</label>
                                    <textarea class="form-control textarea-autosize" id="get-document-autor" name="get-document-autor" placeholder="Autores Separados por ," rows="1" style="height: 35px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-label form-group-green">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="floating-label" for="get-document-palabras-clave">Palabras Clave</label>
                                    <textarea class="form-control textarea-autosize" id="get-document-palabras-clave" name="get-document-palabras-clave" placeholder="Palabras Clave Separadas por ," rows="1" style="height: 35px;"></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="floating-label" for="get-document-date">Año Pulbicacion</label>
                                    <input class="form-control" id="get-document-date" name="get-document-date" placeholder="<?php echo date (" Y "); ?>" type="number" max="9999" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-label form-group-green">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="floating-label" for="get-document-tipo">Tipo Documento</label>
                                    <select class='form-control' id='get-document-tipo' name='get-document-tipo'>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-alt">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <button class="btn btn-block btn-alt waves-button waves-effect waves-light">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div id="card-result" class="container">
            </div>
        </div>
    </div>
    <footer class="footer">
        <?php include_once( "footer.php"); ?>
    </footer>
    <div aria-hidden="true" class="modal fade" id="modal-ver-documento" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div id="iframedocumentos" class="modal-content">
            </div>
        </div>
    </div>
    <div aria-hidden="true" class="modal fade" id="modal-puntear-documento" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">&times;</a>
                    <h2 class="modal-title">Puntear Documento</h2>
                </div>
                <form class="form" name="form-puntear-documents" id="form-puntear-documents" method="POST" autocomplete="off">
                    <div class="modal-inner">
                        <div class="form-group form-group-label form-group-green">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="floating-label" for="puntear-document-puntos">Puntos</label>
                                    <input class="form-control" id="puntear-document-puntos" name="puntear-document-puntos" placeholder="5" type="number" max="5" min="1" required>
                                    <span class="form-help form-help-msg text-alt">Valores entre 1-5<i class="form-help-icon icon icon-error"></i></span>
                                    <input class="form-control" id="puntear-document-id" name="puntear-document-id" type="hidden">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="text-right">
                            <button class="btn btn-flat btn-alt" data-dismiss="modal" type="submit" onclick="punteardocumento()" >OK</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                url: "controlador/tipodocumento/acciones.php?accion=1",
                success: function(data) {
                    if (data.success) {
                        $('#get-document-tipo').html(data.data).fadeIn();
                        $.ajax({
                            type: "POST",
                            url: "controlador/documento/acciones.php?accion=2&userself=1",
                            data: $("#form-get-documents").serialize(),
                            success: function(data) {
                                if (data.success) {
                                        $('#card-result').html(data.data).fadeIn();
                                } else {
                                    $('#card-result').html("").fadeIn();
                                }
                            }
                        });
                    }
                }
            });
        });

        $(function() {
            $("#form-get-documents").submit(function() {
                $.ajax({
                    type: "POST",
                    url: "controlador/documento/acciones.php?accion=2&userself=1",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#card-result').html(data.data).fadeIn();
                        } else {
                            $('#card-result').html("").fadeIn();
                        }
                    }
                });
                return false;
            });
        });

        function mostrar(url) {
            url = "https://docs.google.com/gview?url=" + url + "&embedded=true";
            html = "<div class='modal-heading'><a class='modal-close' data-dismiss='modal'>&times;</a><h2 class='modal-title'>Documento</h2></div><iframe class='iframe-seamless' src='" + url + "' title='documents'></iframe>";
            $('#iframedocumentos').html(html).fadeIn();
        };

        function borrar(document) {
            var formData = {
                'get-document-id': document
            };
            $.ajax({
                type: "POST",
                url: "controlador/documento/acciones.php?accion=3",
                data: formData,
                success: function(data) {
                    if (data.success) {
                        $.ajax({
                            type: "POST",
                            url: "controlador/documento/acciones.php?accion=2&userself=1",
                            data: $("#form-get-documents").serialize(),
                            success: function(data) {
                                if (data.success) {
                                    $('#card-result').html(data.data).fadeIn();
                                } else {
                                    $('#card-result').html("").fadeIn();
                                }
                            }
                        });
                    }
                }
            });
        };
        function puntear(document) {
            $('#puntear-document-id').val(document);
        };
        function punteardocumento() {
            $.ajax({
                type: "POST",
                url: "controlador/documento/acciones.php?accion=4",
                data: $("#form-puntear-documents").serialize()
            });
        };
    </script>
</body>

</html>