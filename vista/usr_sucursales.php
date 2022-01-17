<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="map" style="width:100%;height:700px">

            </div>
        </div>
    </div>
</div>
<?php

$sucursales = SocioModelo::mdlMostrarSucursales(1);
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
                $label = "<center><strong>".$scl['scl_nombre']."</strong></center>".$scl['scl_calle']." ".$scl['scl_ne']." ".$scl['scl_ne']." ".$scl['scl_municipio']." CP.".$scl['scl_cp'].", ".$scl['scl_estado'].", México";
            ?>
                L.marker([<?php echo $scl['scl_lat'] ?>, <?php echo $scl['scl_lon'] ?>]).addTo(map)
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
</script>