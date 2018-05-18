<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <p id="demo">Clique no botão para receber as coordenadas:</p>

        <button onclick="getLocation()">Clique Aqui</button>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script>
            var x = document.getElementById("demo");
            function getLocation()
            {
                if (navigator.geolocation)
                {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    x.innerHTML = "Seu browser não suporta Geolocalização.";
                }
            }
            function showPosition(position)
            {
                
                var lat = position.coords.latitude;
                var long = position.coords.longitude;
                var latlng = lat + "," + long;
                var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&sensor=true";
                $.getJSON(url, function (data) {
                    for (var i = 0; i < data.results.length; i++)
                    {
                        var adress = data.results[i].formatted_address;
                        //alert(adress);
                        x.innerHTML = adress;
                        document.getElementById('map').value = adress;
                        endereco_campo.value = adress;
                    }
                });
            }
            function showError(error)
            {
                switch (error.code)
                {
                    case error.PERMISSION_DENIED:
                        x.innerHTML = "Usuário rejeitou a solicitação de Geolocalização."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        x.innerHTML = "Localização indisponível."
                        break;
                    case error.TIMEOUT:
                        x.innerHTML = "A requisição expirou."
                        break;
                    case error.UNKNOWN_ERROR:
                        x.innerHTML = "Algum erro desconhecido aconteceu."
                        break;
                }
            }
            ;
        </script>
    </body>
</html>
