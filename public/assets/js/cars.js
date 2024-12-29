window.onload = function() {
    if (!localStorage.getItem('visited')) {
        document.getElementById('popup-modal').classList.remove('hidden');
        localStorage.setItem('visited', 'true');
    }

    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                getLocationTitle(latitude, longitude);
            }, function(error) {
                setDefaultLocation();
            });
        } else {
            setDefaultLocation();
        }
    }

    function getLocationTitle(latitude, longitude) {
        var apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=b7ac6d74467f4d799acfe39c906fc968`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results[0]) {
                    var locationTitle = data.results[0].formatted;
                    document.getElementById('user-location').innerText = `الموقع: ${locationTitle}`;
                } else {
                    setDefaultLocation();
                }
            })
            .catch(() => {
                setDefaultLocation();
            });
    }

    function setDefaultLocation() {
        var defaultLatitude = 23.8859;
        var defaultLongitude = 45.0792;
        document.getElementById('user-location').innerText = `الموقع: (السعودية)`;
    }

    document.getElementById('accept-location').addEventListener('click', function() {
        getUserLocation();
        document.getElementById('popup-modal').classList.add('hidden');
    });

    document.getElementById('decline-location').addEventListener('click', function() {
        setDefaultLocation();
        document.getElementById('popup-modal').classList.add('hidden');
    });

    getUserLocation();
};
