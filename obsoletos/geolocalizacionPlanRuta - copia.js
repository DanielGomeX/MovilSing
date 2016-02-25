/*
$(document).ready(function(){

  alert("document is ready");
});
*/

alert("document is ready");


function initialize() {
var lat;
var lon;

$.ajax({
          url: 'ajax',
          type: 'post',
          async: true,
          //dataType : 'json',
          data: '',
          success:function(response){
            console.log(response);
            obj = JSON.parse(response);

            alert(obj.length.toString())
            for(var i in obj){
              lat=obj[i].latitud;
              lon=obj[i].longitud;
              alert(obj[i].nombre.trim() + ': ' +obj[i].latitud + ' ,'+obj[i].longitud);
            }

            /*
            $.each(response, function(k, v) {
                 alert(k + ' | ' + v);
            });
            */

          },
          error : function(xhr, status) {
            alert('Disculpe, existió un problema al obtener los datos');
          }
        });

/*
$.ajax({
        type: "POST",
        url:"ajax",
        async: true,
        success: function(datos){
            var dataJson = eval(datos);

            for(var i in dataJson){
                alert(dataJson[i].cliente+ " - " + dataJson[i].nombre);
            }

        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
});
*/

  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(21.841984, -102.285956)
  };

  var map = new google.maps.Map(document.getElementById('mapaPlanRuta'),mapOptions);

  //var norte = new google.maps.LatLng(21.906207, -102.290083);
  var norte = new google.maps.LatLng(lat, lon);
  var sur = new google.maps.LatLng(21.841984, -102.285956);
  var oriente = new google.maps.LatLng(21.865762, -102.245832);
  var poniente = new google.maps.LatLng(21.893087, -102.312442);

  var posicionMarcadores = [
        norte,
        sur,
        oriente,
        poniente
       ];

  var nombreMarcadores = [
        "20020331",
        "20024582",
        "20029060",
        "20029075"
       ];

  var descripcionMarcadores = [
        "PERALTA REBOLLEDO MAGALY",
        "PRAXAIR MEXICO S DE RL DE CV",
        "DE LEON CARO ZENON",
        "ESTRADA HERNANDEZ ZENAYDA LIZBET"
       ];

  for (var i = 0; i < posicionMarcadores.length; i++) {
    var position = posicionMarcadores[i];

    var marker = new google.maps.Marker({
      position: position,
      map: map
    });

    marker.setTitle(nombreMarcadores[i]);
    attachSecretMessage(marker, descripcionMarcadores[i]);
  }
}

// The five markers show a secret message when clicked
// but that message is not within the marker's instance data
function attachSecretMessage(marker, desc) {
  //var message = ['This', 'is', 'the', 'secret', 'message'];
  var infowindow = new google.maps.InfoWindow({
    content: desc
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

