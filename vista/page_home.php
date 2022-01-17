<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="dist/img/logo_rfm.png" width="200">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#">Sucursales <span class="sr-only">(current)</span></a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li> -->

        </ul>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-1">
            <div id="map" style="width:100%;height:730px">

            </div>
        </div>

    </div>
</div>
<?php

$sucursales = SocioModelo::mdlMostrarSucursales(0);
// var_dump($sucursales);

?>
<script>
    navigator.geolocation.getCurrentPosition(
        (pos) => {

            const {
                coords
            } = pos
            const {
                latitude,
                longitude
            } = coords
            var map = L.map('map').setView([latitude, longitude], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            <?php
            foreach ($sucursales as $key => $scl) :
                $site_web = "<strong>Sitio web: </strong> <a href='$scl[scl_sitio]' target='_blank'>$scl[scl_sitio]<a>";
                $tel = "<strong>Teléfono: </strong> <a href='tel:$scl[sc_tel]' target='_blank'>$scl[sc_tel]<a>";
                $direccion = "<strong>Dirección: </strong> <a href='https://maps.google.com?q=$scl[scl_lat],$scl[scl_lon]' target='_blank'>Ir a la direccion<a>";
                $label = "<div  ><center><strong>" . $scl['scl_nombre'] . "</strong></center>" . $scl['scl_calle'] . " " . $scl['scl_ne'] . " " . $scl['scl_ne'] . " " . $scl['scl_municipio'] . " CP." . $scl['scl_cp'] . ", " . $scl['scl_estado'] . ", México</div><br> $site_web <br> $tel <br> $direccion ";
                // $label = "<div  ><center><strong>" . $scl['scl_nombre'] . "</strong></center>";
            ?>

                L.marker([<?php echo $scl['scl_lat'] ?>, <?php echo $scl['scl_lon'] ?>]).addTo(map)
                    .bindPopup("<?php echo $label ?>")

            <?php endforeach; ?>

            setTimeout(() => {
                map.panTo(new L.LatLng(latitude, longitude))
            }, 5000)
        },
        (error) => {
            console.log(error)
        }, {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        })



    // function opens(e) {
    //     alert(e.getLatLng());
    // }
    // function opens(e) {alert(e.latlng);}
</script>