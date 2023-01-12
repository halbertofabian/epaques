<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SocioControlador
{
    public static function ctrAgregarSocio()
    {
        // PREGUNTAR SI ES UN CORREO 
        if (!socioControlador::is_valid_email($_POST['scs_correo'])) {
            return array(
                'status' => false,
                'mensaje' => '¡Escriba un correo valido!'
            );
        }

        // Preguntar si ya existe el correo 
        $isEmail = SocioModelo::mdlIssetSocioByEmail($_POST['scs_correo']);

        if ($isEmail) {
            return array(
                'status' => false,
                'mensaje' => 'Este correo ya esta siendo usado por otro socio'
            );
        }
        $ctas_cta = date("ymdHis");
        $ctas_id_padre = $_SESSION['session_usr']['scs_id'];
        $scs_token = base64_encode(uniqid());

        $ctas_p = 0;
        if (isset($_POST['scs_p'])) {
            $ctas_p = 1;
        }

        $scs_correo = $_POST['scs_correo'];
        $scs_wsp = $_POST['scs_cp'] . '' . $_POST['scs_wp'];
        $scs_telefono = $scs_wsp;

        $datos = array(
            'ctas_cta' => $ctas_cta,
            'ctas_id_padre' => $ctas_id_padre,
            'scs_token' => $scs_token,
            'ctas_p' => $ctas_p,
            'scs_wsp' => $scs_wsp,
            'scs_telefono' => $scs_telefono,
            'scs_cuenta' => $ctas_cta,
            'scs_correo' => $scs_correo,
            'scs_perfil' => 'Socio Administrador'
        );
        $createToCta = SocioModelo::mdlAgregarCuenta($datos);
        if ($createToCta) {
            $createSocio = SocioModelo::mdlAgregarSocio($datos);
            if ($createSocio) {
                $correo = SocioControlador::ctrEnviarCorreoVerificacion(array(
                    'usr_correo' => $_POST['scs_correo'],
                    'usr_token' => $scs_token,
                    'url_base' => $_POST['url_base']
                ));
                return array(
                    'status' => true,
                    'mensaje' => 'Socio dado de alta',
                    'token' => $scs_token,
                    'wp' => $scs_wsp
                );
            } else {
                return array(
                    'status' => true,
                    'mensaje' => 'No se pudo registrar a este socio, intantalo de nuevo',
                );
            }
        } else {
            return array(
                'status' => true,
                'mensaje' => 'No se pudo registrar la cuenta, intantalo de nuevo',
            );
        }
    }
    public static function ctrAgregarSocioHome($cta)
    {
        // PREGUNTAR SI ES UN CORREO 
        if (!socioControlador::is_valid_email($cta['scs_correo'])) {
            return array(
                'status' => false,
                'mensaje' => '¡Escriba un correo valido!'
            );
        }

        // Preguntar si ya existe el correo 
        $isEmail = SocioModelo::mdlIssetSocioByEmail($cta['scs_correo']);

        if ($isEmail) {
            return array(
                'status' => false,
                'mensaje' => 'Este correo ya esta siendo usado por otro socio'
            );
        }
        $ctas_cta = date("ymdHis");
        // $ctas_id_padre = $_SESSION['session_usr']['scs_id'];
        $ctas_id_padre = $cta['scs_id'];
        $scs_token = base64_encode(uniqid());

        $ctas_p = 0;
        if (isset($cta['scs_p'])) {
            $ctas_p = 1;
        }

        $scs_correo = $cta['scs_correo'];
        $scs_wsp = $cta['scs_cp'] . '' . $cta['scs_wp'];
        $scs_telefono = $scs_wsp;

        $datos = array(
            'ctas_cta' => $ctas_cta,
            'ctas_id_padre' => $ctas_id_padre,
            'scs_token' => $scs_token,
            'ctas_p' => $ctas_p,
            'scs_wsp' => $scs_wsp,
            'scs_telefono' => $scs_telefono,
            'scs_cuenta' => $ctas_cta,
            'scs_correo' => $scs_correo,
            'scs_perfil' => 'Socio Administrador'
        );
        $createToCta = SocioModelo::mdlAgregarCuenta($datos);
        if ($createToCta) {
            $createSocio = SocioModelo::mdlAgregarSocio($datos);
            if ($createSocio) {
                $correo = SocioControlador::ctrEnviarCorreoVerificacion(array(
                    'usr_correo' => $cta['scs_correo'],
                    'usr_token' => $scs_token,
                    'url_base' => $cta['url_base']
                ));
                return array(
                    'status' => true,
                    'mensaje' => 'Socio dado de alta',
                    'token' => $scs_token,
                    'wp' => $scs_wsp
                );
            } else {
                return array(
                    'status' => true,
                    'mensaje' => 'No se pudo registrar a este socio, intantalo de nuevo',
                );
            }
        } else {
            return array(
                'status' => true,
                'mensaje' => 'No se pudo registrar la cuenta, intantalo de nuevo',
            );
        }
    }

    public static function ctrTerminarRegistro()
    {
        if ($_POST['scs_token'] == "") {
            return array(
                'status' => false,
                'mensaje' => 'Este registro ya no se encuentra disponible, es probable que ya se haya completado'
            );
        } else {
            $_POST['scs_token'] = "";
        }

        SocioModelo::mdlTerminarRegistroCuenta($_POST);
        SocioModelo::mdlTerminarRegistroSocio($_POST);

        return array(
            'status' => true,
            'mensaje' => 'Registro completado',
            'pagina' => './system'
        );
    }

    public static function ctrGuardarSucursales()
    {
        $datos_scl = array(
            'scl_nombre' => $_POST['scl_nombre'],
            'scl_cp' => $_POST['scl_codigo_postal'],
            'scl_estado' => $_POST['scl_estado'],
            'scl_municipio' => $_POST['scl_delegacion_municipio'],
            'scl_colonia' => $_POST['scl_colonia'],
            'scl_calle' => $_POST['scl_calle'],
            'scl_ne' => $_POST['scl_no_exterior'],
            'scl_ni' => $_POST['scl_no_interior'],
            'scl_c1' => $_POST['scl_entre_calle_1'],
            'scl_c2' => $_POST['scl_entre_calle_2'],
            'scl_cuenta' => $_SESSION['session_usr']['scs_cuenta'], // Arreglar cuando haya sesion
            'scl_lat' => $_POST['scl_lat'],
            'scl_lon' => $_POST['scl_lon'],
            'scl_sitio' => $_POST['scl_sitio'],
            'sc_tel' => $_POST['sc_tel'],

        );

        $registrarSucursal = SocioModelo::mdlAgregarSucursal($datos_scl);
        if ($registrarSucursal) {
            return array(
                'status' => true,
                'mensaje' => 'Sucursal agregada',
                'pagina' => './system'
            );
        } else {
            return array(
                'status' => false,
                'mensaje' => 'Ocurrio un error, no se pudo agregar la sucursal'
            );
        }
    }

    public  function ctrIniciarSesion()
    {
        if (isset($_POST['btnIniciarSesion'])) {
            $usuario = SocioModelo::mdlIniciarSesion($_POST['scs_correo']);
            if ($usuario) {

                if ($_POST['scs_clave'] == $usuario['scs_clave']) {
                    $cuenta = SocioModelo::mdlMostrarCuentaSocio($usuario['scs_cuenta']);
                    $_SESSION['session'] = true;
                    $_SESSION['session_usr'] =  $usuario;
                    $_SESSION['session_cta'] =  $cuenta;

                    header('Location:./');
                } else {
                    echo '<div class="alert alert-danger mt-1 text-center"> <strong> Usuario o contraseña incorrecto </strong> </div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-1 text-center"> <strong> Usuario o contraseña incorrecto </strong> </div>';
            }
        }
    }

    public  static  function is_valid_email($str)
    {
        $matches = null;
        return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
    }


    public static function ctrEnviarCorreoVerificacion($data)
    {

        try {


            $mail = new PHPMailer(true);

            $mail->CharSet = "UTF-8";

            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.hostinger.mx';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'empaques@ifixitmor.com';                     // SMTP username
            $mail->Password   = 'Empaques@1234';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('empaques@ifixitmor.com', 'ROMFILM -EMPAQUES UNIVERSALES');
            $mail->addAddress($data['usr_correo'], '');
            // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verificación de cuenta';
            $mail->Body  = 'Da click aquí en el siguiente enlace para terminar tu registro <a href="' . $data['url_base'] . '?registro=true&token=' . $data['usr_token'] . '" target="_blank" >Terminar mi registro</a> ';
            $mail->send();

            return true;
        } catch (PHPMailer $th) {
            throw $th;
            return false;
        }
    }
}
