<div class="container-fluid mt-1">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-bordered table-hover tableSocios">
                <thead>
                    <tr>
                        <th>CUENTA</th>
                        <th>NOMBRE DE LA EMPRESA</th>
                        <th>RFC</th>
                        <th>RAZON SOCIAL</th>
                        <th>CREAR NIVEL DE DIST.</th>
                    </tr>
                </thead>
                <tbody id="tbodySocios">
                </tbody>
            </table>
        </div>
    </div>

    <?php if ($_SESSION['session_cta']['ctas_p']) : ?>
        <button class="btn btn-dark btn-flotante btnAbrirModalSocio" data-toggle="modal" data-target="#mdlAgregarSocio"><i class="fas fa-plus"></i></button>
    <?php endif; ?>
</div>

<?php


?>


<!-- Modal -->
<div class="modal fade" id="mdlAgregarSocio" tabindex="-1" role="dialog" aria-labelledby="mdlAgregarSocioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlAgregarSocioLabel">Agregar nuevo socio a mi red de distribución</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAgregarSocio" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="scs_correo">Correo electrónico</label>
                                <input type="hidden" name="url_base" id="url_base" value="<?= $url_base ?>">
                                <input type="email" name="scs_correo" id="scs_correo" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="scs_cp">CP</label>
                                <input type="number" name="scs_cp" id="scs_cp" class="form-control" placeholder="" value="521">
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label for="scs_wp">WhatsApp</label>
                                <input type="number" name="scs_wp" id="scs_wp" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <label class="form-check-label float-right">
                                    <input type="checkbox" class="form-check-input float-right" name="scs_p" id="scs_p" value="1" checked>
                                    Autorizar permisos para que pueda agregar más socios a su red de distribución
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnAgregarSocio">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        mostrarSocios()
    })
    $(".btnAbrirModalSocio").on("click", function() {
        $('#mdlAgregarSocio').modal({
            backdrop: 'static',
            keyboard: false
        })

    })
    $("#formAgregarSocio").on("submit", function(e) {
        e.preventDefault();
        var datos = new FormData(this);
        datos.append("btnAgregarSocio", true);
        $.ajax({
            type: "POST",
            url: './ajax/socios.ajax.php',
            data: datos,
            cache: false,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {

                $("#btnAgregarSocio").attr("disabled", true)
                $("#btnAgregarSocio").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Creando socio...`)
            },
            success: function(res) {
                $("#btnAgregarSocio").attr("disabled", false)
                $("#btnAgregarSocio").html(`Agregar`)
                if (res.status) {

                    mostrarSocios()

                    swal({
                            title: 'Socio dado de alta',
                            text: '¿Quieres mandar el acceso por whatsApp?',
                            icon: "success",
                            buttons: {
                                correo: {
                                    text: "No",
                                    value: "c",

                                },
                                whatsapp: {
                                    text: "Si",
                                    value: "w",

                                },
                                // defeat: true,
                            },
                        })
                        .then((value) => {
                            switch (value) {

                                case "c":
                                    swal({
                                        title: "",
                                        text: 'Se envio un correo de verificación al socio',
                                        icon: "success",
                                        button: "OK",
                                    });
                                    break;

                                case "w":
                                    $url = "<?= $url_base ?>?registro=true%26token=" + res.token
                                    window.open('https://wa.me/' + res.wp + '?text=' + $url, '_blank')
                                    break;

                                default:
                                    swal("Got away safely!");
                            }
                        });


                } else {
                    swal({
                        title: "¡Error!",
                        text: res.mensaje,
                        icon: "error",
                        button: "Esta bien",
                    });
                }
            }
        });



    })

    function mostrarSocios() {
        var datos = new FormData();
        datos.append("btnMostrarSocios", true);
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
                var listaSocios = "";
                res.forEach(scs => {


                    var boton = "";
                    if (scs.ctas_p == 1) {
                        boton = `<button class="btn btn-success" id="btn_${scs.ctas_id}"  onclick="auto(0,'${scs.ctas_id}')"  type="button">AUTORIZADO</button>`;
                    } else {
                        boton = `<button class="btn btn-danger" id="btn_${scs.ctas_id}"   onclick="auto(1,'${scs.ctas_id}')"  type="button">DENEGADO</button>`;
                    }

                    listaSocios +=

                        `
                        <tr>

                            <td>${scs.ctas_cta}</td>
                            <td>${scs.ctas_nombre} </td>
                            <td>${scs.ctas_rcf}</td>
                            <td>${scs.ctas_razon_social}</td>
                            <td>${boton}</td>
                        
                        </tr>

                    `;

                });

                $("#tbodySocios").html(listaSocios);
            }
        })
    }

    function auto(ctas_p, ctas_id) {


        var datos = new FormData();

        datos.append("btnPermisoScocio", true);
        datos.append("ctas_id", ctas_id);
        datos.append("ctas_p", ctas_p);
        $.ajax({
            type: "POST",
            url: './ajax/socios.ajax.php',
            data: datos,
            cache: false,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#btn_" + ctas_id).attr("disabled", true);

            },
            success: function(res) {
                if (res) {
                    $("#btn_" + ctas_id).attr("disabled", false);
                    mostrarSocios()

                }
            }
        })



    }
</script>

<style>
    .btn-flotante {


        font-size: 16px;
        /* Cambiar el tamaño de la tipografia */
        text-transform: uppercase;
        /* Texto en mayusculas */
        font-weight: bold;
        /* Fuente en negrita o bold */
        color: #ffffff;
        /* Color del texto */
        border-radius: 100%;
        /* Borde del boton */
        letter-spacing: 2px;
        /* Espacio entre letras */
        background-color: #343A40;
        /* Color de fondo */
        padding: 18px 30px;
        /* Relleno del boton */
        position: fixed;
        bottom: 80px;
        right: 40px;
        transition: all 300ms ease 0ms;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        z-index: 99;
    }

    .btn-flotante:hover {
        background-color: #2c2fa5;
        /* Color de fondo al pasar el cursor */
        box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
        transform: translateY(-7px);
    }

    @media only screen and (max-width: 600px) {
        .btn-flotante {
            font-size: 14px;
            padding: 12px 20px;
            bottom: 20px;
            right: 20px;
        }
    }
</style>