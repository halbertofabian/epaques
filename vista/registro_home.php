<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="formAgregarSocio" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="scs_correo">Correo electrónico</label>
                                <input type="hidden" name="url_base" id="url_base" value="<?= $url_base ?>">
                                <input type="hidden" name="scs_id" id="scs_id" value="<?= isset($_GET['scs']) ? $_GET['scs'] : ''  ?>">
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
                                    Autorizar permisos para agregar más socios a su red de distribución.
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
    $("#formAgregarSocio").on("submit", function(e) {
        e.preventDefault();
        var datos = new FormData(this);
        datos.append("btnAgregarSocioHome", true);
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


                    var url = "<?= $url_base ?>?registro=true&token=" + res.token


                    swal({
                            title: 'Socio dado de alta',
                            text: 'Continua con el registro',
                            icon: "success",
                            button: "Continuar",
                        })
                        .then((value) => {
                            window.location.href = url;
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
</script>