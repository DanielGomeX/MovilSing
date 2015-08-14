
//alert("document is ready");

  function initialize() {

    var mapOptions = {
      zoom: 5,
      center: new google.maps.LatLng(21.8807, -102.296086)
    };

    var map = new google.maps.Map(document.getElementById('mapaPlanRuta'),mapOptions);

    $.ajax({
            url: 'ajax',
            type: 'post',
            async: true,
            //dataType : 'json',
            data: '',
            success:function(response){
              //console.log(response);
                obj = JSON.parse(response);

                for(var i in obj){

                  //alert(lat=obj[i].latitud);
                  //alert(lon=obj[i].longitud);

                  var position = new google.maps.LatLng(obj[i].latitud, obj[i].longitud);
                  var marker = new google.maps.Marker({
                                                position: position,
                                                map: map
                                              });

                  marker.setTitle(obj[i].cliente);
                  attachSecretMessage(marker, obj[i].nombre);
                  //alert(obj[i].nombre.trim() + ': ' +obj[i].latitud + ' ,'+obj[i].longitud);

                }//for
            },
            error : function(xhr, status) {
              alert('Error, existió un problema al obtener los datos');
            }
          });
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

