<div class="container-fluid p-1">
    <form id="formDireccionScl" class="card-body">
        <div class="row">
            <div class="col-md-6 ">
                <div class="card">
                    <div class="card-header" id="scr_direccion_sucursal_clp">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseDireccion" aria-expanded="true" aria-controls="collapseDireccion">
                                <strong>Datos de la sucursal</strong>
                            </button>
                        </h5>
                    </div>


                    <input type="hidden" name="scl_propietario" id="scl_propietario" value="">
                    <div class="row p-2">
                        <div class="form-group col-md-6">
                            <label for="scl_nombre">Nombre de la sucursal</label>
                            <input type="text" name="scl_nombre" id="scl_nombre" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sc_tel">Teléfono</label>
                            <input type="text" name="sc_tel" id="sc_tel" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="scl_sitio">Sitio web</label>
                            <input type="url" name="scl_sitio" id="scl_sitio" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="scl_codigo_postal">Código postal</label>
                            <input type="text" name="scl_codigo_postal" id="scl_codigo_postal" class="form-control" placeholder="" aria-describedby="helpId" value="">
                            <small id="helpId" class="text-muted"> <a class="float-right" target="_blank" href="https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/Descarga.aspx">No sé mi código</a> </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="scl_estado">Estado</label>
                            <input type="text" name="scl_estado" id="scl_estado" class="form-control" value="" readonly placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="scl_delegacion_municipio">Delegación / Municipio </label>
                            <input type="text" name="scl_delegacion_municipio" id="scl_delegacion_municipio" class="form-control" value="" readonly placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="scl_colonia">Colonia / Asentamiento</label>
                            <select class="form-control select2" name="scl_colonia" id="scl_colonia" value="">
                                <option value="">Selecciona tu Colonia</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="scl_calle">Calle </label>
                            <input type="text" name="scl_calle" id="scl_calle" class="form-control" value="" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="scl_no_exterior">Nº exterior </label>
                            <input type="text" name="scl_no_exterior" id="scl_no_exterior" class="form-control" value="" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="scl_no_interior">Nº interior / Depto </label>
                            <input type="text" name="scl_no_interior" id="scl_no_interior" class="form-control" value="" placeholder="Opcional">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="scl_entre_calle_1">Entre calle 1 </label>
                            <input type="text" name="scl_entre_calle_1" id="scl_entre_calle_1" class="form-control" value="" placeholder="Opcional">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="scl_entre_calle_2">Entre calle 2 </label>
                            <input type="text" name="scl_entre_calle_2" id="scl_entre_calle_2" class="form-control" value="" placeholder="Opcional">
                        </div>


                        <div class="form-group col-12">
                            <input type="text" id="scl_lat" name="scl_lat" value="">
                            <input type="text" id="scl_lon" name="scl_lon" value="">
                            <button type="button" class="btn btn-dark float-right ml-1" id="obtenerUbicacion"><i class="fas fa-map-marker-alt"></i> Obtner ubicación</button>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div id="map" style="width:100%;height:600px">

                </div>

            </div>
            <div class="col-12 col-md-6"></div>
            <div class="col-12 col-md-6 form-group mt-1">
                <input type="submit" class="btn btn-primary btn-block" value="Agregar sucursal">
            </div>
        </div>
    </form>
</div>


<script>
    $("#scl_codigo_postal").on("change", function(e) {
        e.preventDefault()


        var codigo = $(this).val();
        if (codigo == "") {
            return;
        }
        $('#scl_colonia option').remove();
        $.ajax({
            type: "GET",
            // url: `https://apisgratis.com/api/codigospostales/v2/colonias/cp/?valor=${codigo}`,
            // https://apisgratis.com/api/codigospostales/v2/colonias/cp/?valor=
            url: `https://api-cp.multiservicios-web.com.mx/query/info_cp/${codigo}?token=cf683454-21ac-40c1-a32f-daaa44796206`,
            // data: datos,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res)
                res.forEach(element => {
                    $("#scl_estado").val(element.response.estado);
                    $("#scl_delegacion_municipio").val(element.response.municipio);
                    $("#scl_colonia").append(`<option value="${element.response.asentamiento}">${element.response.asentamiento}</option>`);
                });

            }
        });
    });
    $("#scl_codigo_postal").on("keyup", function(e) {
        var codigo = $(this).val();
        if (codigo == "") {
            $("#scl_estado").val("");
            $("#scl_delegacion_municipio").val("");
            $("#scl_colonia").html("");
            $("#scl_colonia").append(`<option value="">Selecciona tu Colonia</option>`);
            return;
        }
    });
    $("#formDireccionScl").on("submit", function(e) {
        e.preventDefault()
        var datos = new FormData(this);
        datos.append("btnGuardarDirecSuc", true);
        $.ajax({
            type: "POST",
            url: "./ajax/socios.ajax.php",
            data: datos,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                // startLoadButton()
            },
            success: function(res) {
                // stopLoadButton();
                if (res.status) {
                    // toastr.success(res.mensaje, 'Correcto');
                    swal({
                        title: "¡Muy bien!",
                        text: res.mensaje,
                        icon: "success",
                        button: "Esta bien",
                    });

                    setInterval(function() {
                        window.location.href = res.pagina
                    }, 2000)

                } else {
                    swal({
                        title: "!Error!",
                        text: res.mensaje,
                        icon: "error",
                        button: "Esta bien",
                    });

                }

            }
        });
    });



    var map = L.map('map').setView([0, 0], 18);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);






    $("#obtenerUbicacion").on("click", function() {

        var scl_no_exterior = $("#scl_no_exterior").val();
        var scl_calle = $("#scl_calle").val();
        var scl_delegacion_municipio = $("#scl_delegacion_municipio").val();
        var scl_estado = $("#scl_estado").val();
        var scl_codigo_postal = $("#scl_codigo_postal").val();
        var scl_pais = "Mexico";
        var scl_nombre = $("#scl_nombre").val();
        var label = `<center><strong>${scl_nombre}</strong></center> ${scl_calle+" "+scl_no_exterior+" "+scl_delegacion_municipio+" CP."+scl_codigo_postal+", "+scl_estado+", "+scl_pais}`;
        // var direccion = "205 Narciso Mendoza Jojutla, Morelos, Mexico";
        var direccion = scl_no_exterior + " " + scl_calle + " " + scl_delegacion_municipio + "," + scl_estado + "," + scl_pais
        $.ajax({
            url: 'https://api.positionstack.com/v1/forward',
            data: {
                access_key: 'ba77005f7f8d03d860fe6c7213fb69f2',
                query: direccion,
                output: 'json',
                limit: 1,
            }
        }).done(function(data) {

            $("#scl_lat").val(data.data[0].latitude);
            $("#scl_lon").val(data.data[0].longitude);
            buildMap(data.data[0].latitude, data.data[0].longitude, label)

        });
    });

    function buildMap(lat, lon, label) {

        L.marker([lat, lon]).addTo(map)
            .bindPopup(label)
            .openPopup();

    }

    map.doubleClickZoom.disable()
    map.on('dblclick', e => {

        var scl_no_exterior = $("#scl_no_exterior").val();
        var scl_calle = $("#scl_calle").val();
        var scl_delegacion_municipio = $("#scl_delegacion_municipio").val();
        var scl_estado = $("#scl_estado").val();
        var scl_codigo_postal = $("#scl_codigo_postal").val();
        var scl_pais = "Mexico";
        var scl_nombre = $("#scl_nombre").val();
        var label = `<center><strong>${scl_nombre}</strong></center> ${scl_calle+" "+scl_no_exterior+" "+scl_delegacion_municipio+" CP."+scl_codigo_postal+", "+scl_estado+", "+scl_pais}`;

        let latLng = map.mouseEventToLatLng(e.originalEvent);
        if (marker) { // check
            map.removeLayer(marker); // remove
        }
        var marker = new L.Marker([latLng.lat, latLng.lng], {
            draggable: true
        });
        marker.bindPopup(label).addTo(map);

        $("#scl_lat").val(latLng.lat);
        $("#scl_lon").val(latLng.lng);
        // let latLng = map.mouseEventToLatLng(e.originalEvent);

        // L.marker([latLng.lat, latLng.lng], {

        // }).addTo(map)
    })

    // navigator.geolocation.getCurrentPosition(
    //     (pos) => {
    //         const {
    //             coords
    //         } = pos
    //         const {
    //             latitude,
    //             longitude
    //         } = coords
    //         L.marker([latitude, longitude]).addTo(map)

    //         setTimeout(() => {
    //             map.panTo(new L.LatLng(latitude, longitude))
    //         }, 1000)
    //     },
    //     (error) => {
    //         console.log(error)
    //     }, {
    //         enableHighAccuracy: true,
    //         timeout: 5000,
    //         maximumAge: 0
    //     })
</script>