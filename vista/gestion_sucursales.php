<div class="container-fluid p-1">
    <div class="row">
        <?php

        $sucursales = SocioModelo::mdlMostrarSucursales(1, $_SESSION['session_usr']['scs_cuenta']);
        foreach ($sucursales as $key => $scl) :
        ?>
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title text-dark"><i class="fas fa-store"></i> <?= $scl['scl_nombre'] ?></h4>
                        <p class="card-text">
                            <?= $scl['scl_calle'] . ' ' . $scl['scl_ne'] . ' ' . $scl['scl_ni'] ?> <br>
                            <?= 'Col. ' . $scl['scl_colonia'] . ' ' . $scl['scl_municipio'] . ' ' . $scl['scl_estado'] . ' ' . $scl['scl_cp'] ?>

                        </p>
                        <p class="card-text">
                            <a href='https://maps.google.com?q=<?= $scl['scl_lat'] . ',' . $scl['scl_lon'] ?>' target='_blank'>Ver ubicación<a>
                                    <button type="button" scl_id="<?= $scl['scl_id'] ?>" scl_nombre="<?= $scl['scl_nombre'] ?>" class="btn btn-danger float-right btnBorrarScl"><i class="fas fa-trash-alt"></i></button>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(".btnBorrarScl").on("click", function() {
        var scl_nombre = $(this).attr("scl_nombre")
        var scl_id = $(this).attr("scl_id")
        swal({
                title: "¿Esta seguro(a)?",
                text: "Eliminará la sucursal con nombre de " + scl_nombre,
                icon: "warning",
                buttons: ['No', 'Si, eliminar sucursal'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var datos = new FormData();

                    datos.append("btnEliminarSucursal", true);
                    datos.append("scl_id", scl_id);
                    $.ajax({
                        type: "POST",
                        url: './ajax/socios.ajax.php',
                        data: datos,
                        cache: false,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        beforeSend: function() {},
                        success: function(res) {
                            if (res) {
                                swal({
                                    title: "¡Muy bien!",
                                    text: 'Sucursal eliminada',
                                    icon: "success",
                                    button: "OK",
                                });
                                window.location.reload()
                            }
                        }
                    })

                } else {

                }
            });
    })
</script>