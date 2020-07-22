<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta content="IE=edge" http-equiv="X-UA-Compatible">
      <meta content="initial-scale=1.0, width=device-width" name="viewport">
      <title>500</title>
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
         <a class="header-logo" href="index">DIFCON</a>
      </header>
      <div class="content">
         <div class="content-heading">
            <div class="container">
               <h1 class="heading">Status 500 ¡Ups!</h1>
            </div>
         </div>
         <div class="content-inner">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 col-md-10">
                     <h2 class="content-sub-heading">¡Huy! Algo salió mal...</h2>
                     <p>Alguien está en problemas esto no debió ocurrir, tranquilo ya lo estamos solucionando, mientras tanto puedes ver un video en Youtube.</p>
                  </div>
               </div>
            </div>
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
                                    <h1 class="card-heading">Busca algo en Youtube</h1>
                                 </div>
                              </div>
                              <div class="card-inner">
                                 <form class="form" method="GET" action="https://www.youtube.com/results" target="_blank">
                                    <div class="form-group form-group-label form-group-alt">
                                       <div class="row">
                                          <div class="col-md-10 col-md-push-1">
                                             <label class="floating-label" for="buscar-youtube">Ver algo en Youtube</label>
                                             <input class="form-control" name="search_query" id="buscar-youtube" type="text">
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
                                 </form>
                              </div>
                           </div>
                        </div>
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
   </body>
</html>