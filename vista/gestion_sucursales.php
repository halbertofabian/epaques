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
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>