function initMap() {
    var pepiniere = {
        lat: 45.557602,
        lng: -73.582333
    };
    var map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 15,
            center: pepiniere
        });
    var marker = new google.maps.Marker({
        position: pepiniere,
        map: map
    });
}