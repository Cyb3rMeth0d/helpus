<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';


if(!ControlSesion :: sesion_iniciada()) {
  Redireccion :: redirigir(SERVIDOR);
} else {
  Conexion :: abrir_conexion();
  $id = $_SESSION['id_usuario'];
  $nombre = $_SESSION['nombre_usuario'];
  $usuario = RepositorioUsuario :: obtener_usuario_por_id_user(Conexion::obtener_conexion(), $id);
}

?>
<!DOCTYPE html>
<html lang="en">
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
 <script type="text/javascript">
  $('#panelayuda').on('shown.bs.modal', function () {
    $('#entrar').trigger('focus')
  })
</script>

<div class="bg"></div>
<div class="container-fluid panels">
  <div class="row">
    <div class="col-md-2" id="enc_1">
    </div>
    <div class="col-md-8" id="enc_2">
      <nav class="navbar navbar-expand-lg navbar-dark primary-color">

       <a href="<?php echo SERVIDOR ?>"><img class="navbar-brand" src="logo_blanco" alt="logo"></a>

       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
       aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
         <a href="index.php" ><button type="button" class="btn btn-outline-light"><i class="fas fa-home"></i> Inicio</button></a>
       </li>
       <li class="nav-item">
        <button type="button" class="btn btn-outline-light"><i class="fas fa-map-marked-alt"></i> Mapa</button>
      </li>
      <li class="nav-item">
       <button type="button" class="btn btn-outline-light"><i class="fas fa-th"></i> Lista</button>
     </li>

   </ul>
 </div>
 <div class="col">
  <h3 align="right">Bienvenido <?php echo $nombre ?>!</h3>
</div>
</nav>

</div>
<div class="col-md-2 panel_entrar" id="enc_3">

  <div class="row" >
    <div class="col-*">
     <a href="#"><button type="button" id="entrar" class="btn btn-outline-success active" role="button" aria-pressed="true" data-toggle="modal" data-target="#panelayuda"><i class="fas fa-hands-helping"></i> Pedir Ayuda</button></a>
     <div class="modal" id="panelayuda" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pedir Ayuda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Título</label>
                <input type="title" class="form-control" id="title" aria-describedby="titlehelp" placeholder="Resume tu ayuda en pocas palabras">
                <small id="emailHelp" class="Se recomienda poner una breve descripción de tu ayuda"></small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Descripción</label>
                <input type="description" class="form-control" id="descripcion" placeholder="Una pequeña descripción de tu ayuda">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Elige tu tipo de ayuda</label>
                <select class="form-control" id="Categoria">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <label for="prioridad">Prioridad</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">Urgente</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">Normal</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Enviar Ayuda!</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="col-*">
   <a href="<?php echo PERFIL ?>"><button type="button" id="registrar" class="btn btn-outline-primary active" role="button" aria-pressed="true"><i class="fas fa-user-edit"></i> Cuenta</button></a>

 </div>
</div>


</div>
</div>
<div class="container-fluid">

  <div class="row" style="margin-bottom: 10px;" id="panelinfo">

    <div class="col-md-4">
    </div>
    <div class="col-md-8">
      <button type="button"  class="btn btn-outline-primary">0 Usuarios necesitan ayuda</button>
      <button type="button"  class="btn btn-outline-primary">0 Usuarios ayudados</button>
      <button type="button"  class="btn btn-outline-primary">0 Problemas entre usuarios</button>
    </div>
    <div class="col-md-4">
    </div>
  </div>
</div>
<div class="container-fluid full">
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
</div><br><br><br>
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

<script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" 
type="text/javascript" charset="utf-8"></script>
<script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" 
type="text/javascript" charset="utf-8"></script>
<script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js" 
type="text/javascript" charset="utf-8"></script>
</body>
</html>
