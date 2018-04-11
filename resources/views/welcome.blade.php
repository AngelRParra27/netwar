<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/all.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NetwarMonitor</title>
    </head>
    <body>
      <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="">NetwarMonitor</a>
              </div>
              <div class="collapse navbar-collapse navbar-ex1-collapse">
                  <ul class="nav navbar-nav">
                      <li><a href="/contactos">Contactos</a></li>
                      <li><a href="/citas">Control de Citas</a></li>
                      <li><a href="/reporte">Reporte</a></li>

                  </ul>
                 
              </div>
          </div>
      </nav>
      <div class="container">
          @yield('contenido')
      </div>
    </body>
</html>
<script>
   
</script>