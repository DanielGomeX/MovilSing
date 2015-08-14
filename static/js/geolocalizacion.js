    var map;
    var latitud;
    var longitud;

    $(document).ready(function() {

        $("#mapa").hide();

        $('#verMapa').click(function (e){
            e.preventDefault();
            //localizame();
            ubicar();
            $("#mapa").show();
        });
    });


    function localizame() {
        if (navigator.geolocation) { /* Si el navegador tiene geolocalizacion */
            navigator.geolocation.getCurrentPosition(misCoordenadas, errores);
        }else{
            alert('Aviso! Tu navegador no soporta geolocalización. Descarga Chrome o FireFox!');
        }
    }

    function ubicar() {
        if (navigator.geolocation) { /* Si el navegador tiene geolocalizacion */
            latitud = $("#latitud").val();
            longitud = $("#longitud").val();
            cargarMapa();
        }else{
            alert('Aviso! Tu navegador no soporta geolocalización. Utiliza Chrome o FireFox!');
        }
    }

    function misCoordenadas(position) {
        //Se obtienen las coordenas de mi localización actual mediante el objecto position
        latitud = position.coords.latitude; // Guardamos nuestra latitud
        longitud = position.coords.longitude; // Guardamos nuestra longitud
        cargarMapa();
    }

    function errores(err) {
        // Controlamos los posibles errores
        if (err.code == 0) {
            alert("Oops! Algo ha salido mal");
        }
        if (err.code == 1) {
            alert("Oops! No has aceptado compartir tu posición");
        }
        if (err.code == 2) {
            alert("Oops! No se puede obtener la posición actual");
        }
        if (err.code == 3) {
            alert("Oops! Hemos superado el tiempo de espera");
        }
    }


    function cargarMapa() {
        // Creamos un punto con nuestras coordenadas
        var latlon = new google.maps.LatLng(latitud,longitud);

        var myOptions = {
                          zoom: 16,
                          center: latlon, // Definimos la posicion del mapa con el punto
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        };// Configuramos una serie de opciones como el zoom del mapa y el tipo.

        // Creamos el mapa y lo situamos en su capa
        map = new google.maps.Map($("#mapa").get(0), myOptions);

        //Un nuevo punto con nuestras coordenadas para el marcador (flecha)
        var coorMarcador = new google.maps.LatLng(latitud,longitud);

        // Creamos un marcador
        var marcador = new google.maps.Marker({
            position: coorMarcador, //Lo situamos en nuestro punto
            map: map, // Lo vinculamos a nuestro mapa
            title: "Aquí es"
        });
    }
