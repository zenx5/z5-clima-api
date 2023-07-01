addEventListener( 'load',  _ => {
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition( posicion => {
            const {
                longitude: lon,
                latitude: lat
            } = posicion.coords;

            console.log( 'latitude', lat)
            console.log( 'longitude', lon)
            const { origin } = window.location


            fetch(`${origin}/wp-admin/admin-ajax.php?action=get_clima&lat=${lat}&lon=${lon}`).then( response => response.json() )
                .then( json => {
                    let city = json.name,
                    country = json.sys.country,
                    temp = json.main.temp + ' ' + json.units.temp,
                    humidity = json.main.humidity,
                    speed = json.wind.speed + ' ' + json.units.speed;

                    if(humidity<0){
                        humidity = humidity*100;
                    }

                    document.getElementsByClassName('card-clima')[0].style.display = "flex";
                    document.getElementById('clima-temp').innerText = temp;
                    document.getElementById('clima-humi').innerText = humidity + ' %';
                    document.getElementById('clima-spee').innerText = speed;
                    document.getElementById('city').innerText = city + ', '+country;
                } )

        });

    }

});