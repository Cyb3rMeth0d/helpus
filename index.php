<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';

Conexion::abrir_conexion();
$num_reg=RepositorioUsuario::obtener_numero_users(Conexion::obtener_conexion());
Conexion::cerrar_conexion();

if (ControlSesion::sesion_iniciada()) {
  Redireccion::redirigir(INICIO);
}

if (isset($_POST['submit'])) {
  Conexion :: abrir_conexion();
  $date = preg_replace("([^0-9/])", "", $_POST['data']);
  $validador = new ValidadorRegistro($_POST['name'],$_POST['lastname'], $_POST['email'],
    $_POST['password'], $_POST['cpassword'], Conexion :: obtener_conexion());


  if ($validador -> registro_valido()) {
    $usuario = new Usuario('', $validador-> get_firstname(),
      $validador-> get_lastname(), 
      $validador -> get_email(),
      password_hash($validador -> get_password(), PASSWORD_DEFAULT),
      $date ,
      '',
      '',
      '');

    $usuario_insertado = RepositorioUsuario :: insertar_usuario(Conexion :: obtener_conexion(), $usuario);

    if ($usuario_insertado) {
      Redireccion::redirigir(INICIO . '?=' . $usuario->obtener_nombre());
    }
  }
  Conexion:: cerrar_conexion();
  
}


if (isset($_POST['login'])) {
  Conexion::abrir_conexion();

  $validador = new ValidadorLogin($_POST['email'], $_POST['password'], Conexion::obtener_conexion());

  if ($validador -> obtener_error() === '' &&
    !is_null($validador -> obtener_usuario())) {
    ControlSesion::iniciar_sesion(
      $validador -> obtener_usuario() -> obtener_id(),
      $validador -> obtener_usuario() -> obtener_nombre());
  ControlSesion::sesion_iniciada();
  Redireccion::redirigir(INICIO);
}

Conexion::cerrar_conexion();
}
?>
<!DOCTYPE html>
<html class="html" lang="en">
<head>
  <title>Help Us!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1.0, 
  width=device-width" />
  <link rel="stylesheet" type="text/css" 
  href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


  <script src="./bootstrap/jquery.min.js"></script>


  <script src="js/typeahead.js" type="text/javascript" charset="utf-8"></script>



  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/all.js"></script>

  <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-core.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-service.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>

  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/all.css">


</head>
<body>
  <div class="bg"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2" id="enc_1">
         <div class="btn-group btn-group-justified" id="panelinfo">
        <button href="#" type="button" data-toggle="tooltip" title="Usuarios en línea" class="btn btn-outline-primary stadistics" data-placement="left">0 <i class="fas fa-users"></i></button>
        <button type="button" href="#" type="button" data-toggle="tooltip" title="Usuarios activos mensualmente"
        class="btn btn-outline-primary stadistics">0 <i class="fas fa-user-clock"></i></button>
        <button type="button" href="#" type="button" data-toggle="tooltip" title="Usuarios registrados" class="btn btn-outline-primary stadistics"><?php echo $num_reg ?> <i class="fas fa-user-plus"></i></button>
    </div>
      </div>
      <div class="col-md-8" id=enc_2>
        <nav class="navbar navbar-expand-lg navbar-dark primary-color">

         <img class="navbar-brand" src="logo_blanco" alt="logo">

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
         aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <button type="button" class="btn btn-outline-light"><i class="fas fa-home"></i> Inicio</button>
          </li>
          <li class="nav-item">
            <button type="button" class="btn btn-outline-light"><i class="fas fa-map-marked-alt"></i> Mapa</button>
          </li>
          <li class="nav-item">
           <button type="button" class="btn btn-outline-light"><i class="fas fa-th"></i> Lista</button>
         </li>

       </ul>
     </div>
   </nav>

 </div>
 <div class="col-md-2 panel_entrar" id="enc_3">

  <div class="row" >
    <div class="col-*">
     <a href="#"><button type="button" id="entrar" class="btn btn-outline-light"  data-toggle="modal" data-target="#panelogin"><i class="fas fa-sign-in-alt"></i> Entrar</button></a>
     <div class="modal" id="panelogin" tabindex="-1" role="dialog">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Iniciar Sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="role" id="login" method="POST" action="<?php echo SERVIDOR ?>" >
              <div class="form-group">
                <label for="loginEmail">Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="email" placeholder="Email" >
              </div>
              <div class="form-group">
                <label for="loginPassword">Contraseña</label>
                <input type="password" class="form-control" name="password">
                
              </div>

              <button type="submit" name="login" class="btn btn-primary">Iniciar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </form>
          </div>

        </div>
      </div>
    </div>

  </div>
  <div class="col-*">
   <a href="#"> <button type="button" id="registrar" class="btn btn-outline-light" data-toggle="modal" data-target="#panelregistro"><i class="fas fa-user-plus"></i> Registrarse</button></a>
   <div class="modal" id="panelregistro" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="role" id="register" method="POST" action="<?php echo SERVIDOR ?>" >
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Nombre" >
              <small class="Se recomienda poner una breve descripción de tu ayuda"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Apellidos</label>
              <input type="text" class="form-control" name="lastname" placeholder="Apellidos">

            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email"> 
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" name="password" placeholder="Mínimo 6 caracteres, 1 Mayús, y un número">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Repite la contraseña</label>
              <input type="password" class="form-control" name="cpassword">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Fecha nacimiento</label>
              <input type="date" class="form-control" name="data" placeholder="Ej: 29/09/1998">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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

<button type="button" class="btn btn-dark" data-toggle="collapse" data-target="#demo">Collapsible</button>


<div class="container-fluid full">
<div class="collapse" id="demo">
<div id="map" style="width: 100%; height: 850px; background: grey" />

<script  type="text/javascript" charset="UTF-8" >

function addMarkersToMap(map) {
  var parisMarker = new H.map.Marker({lat:41.5399, lng:2.4427});
  map.addObject(parisMarker);

  var romeMarker = new H.map.Marker({lat:41.5312, lng: 2.4454});
  map.addObject(romeMarker);

  var casa = new H.map.Marker({lat:41.572449, lng: 2.439669});
  map.addObject(casa);
}

function moveUiComponents(map, defaultLayers){
// Create the default UI components
var ui = H.ui.UI.createDefault(map, defaultLayers);

// Obtain references to the standard controls.
var mapSettings = ui.getControl('mapsettings');
var zoom = ui.getControl('zoom');
var scalebar = ui.getControl('scalebar');
var panorama = ui.getControl('panorama');

panorama.setAlignment('top-left');
mapSettings.setAlignment('top-left');
zoom.setAlignment('top-left');
scalebar.setAlignment('top-left');
}
var platform = new H.service.Platform({
'app_id': 'dYAwTxmQ8o5itHiMihrf',
'app_code': 'JrYsk5UEq7yq6wAjrSzrEQ',
'useCIT':'true',
'useHTTPS':'true'
});
// Get the default map types from the Platform object:
var defaultLayers = platform.createDefaultLayers();

// Instantiate the map:
var map = new H.Map(
document.getElementById('map'),
defaultLayers.normal.map,
{
zoom: 14.5,
center: { lng:2.4429 , lat: 41.5399 }
});
var behavior=new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
// Create the default UI:

addMarkersToMap(map);
moveUiComponents(map,defaultLayers);


</script>

</div>
</div>
</div>
<script>
  $(document).ready(function(){
      var date_input=$('input[name="data"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
  </script>

<br><br><br>
<div class="row">
  <div class="col-sm"><div class="card">
    <img class="card-img-top" src="img_avatar1.png" alt="Card image">
    <div class="card-body">
      <h4 class="card-title">John Doe</h4>
      <p class="card-text">Some example text.</p>
      <a href="#" class="btn btn-primary">See Profile</a>
    </div>
  </div></div>
  <div class="col-sm"><div class="card">
    <img class="card-img-top" src="img_avatar1.png" alt="Card image">
    <div class="card-body">
      <h4 class="card-title">John Doe</h4>
      <p class="card-text">Some example text.</p>
      <a href="#" class="btn btn-primary">See Profile</a>
    </div>
  </div></div>
  <div class="col-sm"><div class="card">
    <img class="card-img-top" src="img_avatar1.png" alt="Card image">
    <div class="card-body">
      <h4 class="card-title">John Doe</h4>
      <p class="card-text">Some example text.</p>
      <a href="#" class="btn btn-primary">See Profile</a>
    </div>
  </div></div>
  <div class="col-sm"><div class="card">
    <img class="card-img-top" src="img_avatar1.png" alt="Card image">
    <div class="card-body">
      <h4 class="card-title">John Doe</h4>
      <p class="card-text">Some example text.</p>
      <a href="#" class="btn btn-primary">See Profile</a>
    </div>
  </div></div>
</div>
</div>


<script src="./bootstrap/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script type="text/javascript">
$('#panelogin').on('shown.bs.modal', function () {
$('#entrar').trigger('focus')
})
</script>
<script type="text/javascript">
$('#panelregistro').on('shown.bs.modal', function () {
$('#registrar').trigger('focus')
})
</script>

</body>


</html> 
