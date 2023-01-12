<?php
session_start();
require_once '../controlador/socios.controlador.php';
require_once '../modelo/socios.modelo.php';

require_once '../lib/phpMailer/Exception.php';
require_once '../lib/phpMailer/PHPMailer.php';
require_once '../lib/phpMailer/SMTP.php';
class SociosAjax
{

    public function ajaxAgegarSocio()
    {
        $res = SocioControlador::ctrAgregarSocio();
        // var_dump($res);
        echo json_encode($res, true);
    }
    public function ajaxAgegarSocioHome()
    {
        $res = SocioControlador::ctrAgregarSocioHome($_POST);
        // var_dump($res);
        echo json_encode($res, true);
    }
    public function ajaxMostrarSocios()
    {
        $res = SocioModelo::mdlMostrarCuentasSocios(1, $_SESSION['session_usr']['scs_id']);
        // var_dump($res);
        echo json_encode($res, true);
    }
    public function ajaxTerminarRegistro()
    {
        $res = SocioControlador::ctrTerminarRegistro();
        // var_dump($res);
        echo json_encode($res, true);
    }
    public function ajaxGuardarSucusales()
    {
        $res = SocioControlador::ctrGuardarSucursales();
        // var_dump($res);
        echo json_encode($res, true);
    }
    public function ajaxMostrarSucursales()
    {
        $res = SocioModelo::mdlMostrarSucursales(1);
        // var_dump($res);
        echo json_encode($res, true);
    }
    public function ajaxPermisosSocios()
    {
        $res = SocioModelo::mdlPermisos($_POST['ctas_id'],$_POST['ctas_p']);
        
        echo json_encode($res, true);
    }
    public function ajaxEliminarSucursal()
    {
        $res = SocioModelo::mdlEliminarSucursal($_POST['scl_id']);
        
        echo json_encode($res, true);
    }
}

if (isset($_POST['btnAgregarSocio'])) {
    $agregar = new SociosAjax();
    $agregar->ajaxAgegarSocio();
}

if (isset($_POST['btnAgregarSocioHome'])) {
    $agregar = new SociosAjax();
    $agregar->ajaxAgegarSocioHome();
}

if (isset($_POST['btnMostrarSocios'])) {
    $mostrar = new SociosAjax();
    $mostrar->ajaxMostrarSocios();
}

if (isset($_POST['btnMostrarUbicacionesSucursales'])) {
    $mostrar = new SociosAjax();
    $mostrar->ajaxMostrarSucursales();
}

if (isset($_POST['btnTerminarRegistro'])) {
    $terminarR = new SociosAjax();
    $terminarR->ajaxTerminarRegistro(); //
}

if (isset($_POST['btnGuardarDirecSuc'])) {
    $guadarSucurs = new SociosAjax();
    $guadarSucurs->ajaxGuardarSucusales();
}

if (isset($_POST['btnPermisoScocio'])) {
    $permisos = new SociosAjax();
    $permisos->ajaxPermisosSocios();
}
if (isset($_POST['btnEliminarSucursal'])) {
    $eliminarSuc = new SociosAjax();
    $eliminarSuc->ajaxEliminarSucursal();
}



