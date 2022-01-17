<div class="row justify-content-center">
    <div class="col-md-4 mt-5">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="./" class="h1"><b>EMPAQUES</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg"></p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" id="scs_correo" class="form-control" name="scs_correo" placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="scs_clave" id="scs_clave" class="form-control" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary
                             float-right" name="btnIniciarSesion">Iniciar session</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <?php
                    $iniciarSesion = new SocioControlador();
                    $iniciarSesion->ctrIniciarSesion();
                    ?>

                </form>


                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>