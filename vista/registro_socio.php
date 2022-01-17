<?php


$scs_cuenta = SocioModelo::mdlConsultarCuentaByToken($_GET['token']);
$scs_usr = SocioModelo::mdlConsultarSocioByCuentaLimit1($scs_cuenta['ctas_cta']);

?>

<div class="container-fluid mt-1">
    <div class="card">
        <div class="card-body">
            <form id="formTerminarRegistro" method="post">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="alert alert-dark" role="alert">
                            <strong>Datos de la empresa</strong>
                        </div>
                    </div>
                    <input type="hidden" name="ctas_id" id="ctas_id" value="<?= $scs_cuenta['ctas_id'] ?>">
                    <input type="hidden" name="scs_token" id="scs_token" value="<?= $scs_cuenta['scs_token'] ?>">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ctas_cta">Número de cuenta</label>
                            <input type="text" name="ctas_cta" id="ctas_cta" class="form-control" value="<?= $scs_cuenta['ctas_cta'] ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ctas_nombre">Nombre</label>
                            <input type="text" name="ctas_nombre" id="ctas_nombre" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ctas_rcf">RFC</label>
                            <input type="text" name="ctas_rcf" id="ctas_rcf" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ctas_razon_social">Razón social</label>
                            <input type="text" name="ctas_razon_social" id="ctas_razon_social" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="alert alert-dark" role="alert">
                            <strong>Datos del socio</strong>
                        </div>
                    </div>
                    <input type="hidden" name="scs_id" id="scs_id" value="<?= $scs_usr['scs_id'] ?>">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="scs_nombre">Nombre(s)</label>
                            <input type="text" name="scs_nombre" id="scs_nombre" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class=" col-6">
                        <div class="form-group">
                            <label for="scs_app">Apellido paterno</label>
                            <input type="text" name="scs_app" id="scs_app" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class=" col-6">
                        <div class="form-group">
                            <label for="scs_apm">Apellido materno</label>
                            <input type="text" name="scs_apm" id="scs_apm" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class=" col-12 col-md-6">
                        <div class="form-group">
                            <label for="scs_correo">Correo</label>
                            <input type="text" name="scs_correo" id="scs_correo" class="form-control" value="<?= $scs_usr['scs_correo'] ?>" readonly required>
                        </div>
                    </div>
                    <div class=" col-12 col-md-6">
                        <div class="form-group">
                            <label for="scs_clave">Contraseña</label>
                            <input type="password" name="scs_clave" id="scs_clave" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-right btn-block">Registrarme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#formTerminarRegistro").on("submit", function(e) {
        e.preventDefault();
        var datos = new FormData(this);
        datos.append("btnTerminarRegistro", true);
        $.ajax({
            type: "POST",
            url: './ajax/socios.ajax.php',
            data: datos,
            cache: false,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                //     $("#btnEmpezarVenta").attr("disabled", true)
                //     $("#btnEmpezarVenta").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                // Creando venta...`)
            },
            success: function(res) {
                if (res.status) {
                    swal({
                        title: "¡Muy bien!",
                        text: res.mensaje,
                        icon: "success",
                        button: "OK",
                    });
                    setTimeout(function() {
                        window.location.href = res.pagina;
                    }, 200)
                } else {
                    swal({
                        title: "¡Error!",
                        text: res.mensaje,
                        icon: "error",
                        button: "OK",
                    });
                }
            }
        });
    })
</script>