<?php

require_once 'conexion.php';

class SocioModelo
{
    public static function mdlAgregarCuenta($cta)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_cuenta_socio_ctas (ctas_cta,ctas_id_padre,ctas_p,scs_token) VALUES(?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindParam(1, $cta['ctas_cta']);
            $pps->bindParam(2, $cta['ctas_id_padre']);
            $pps->bindParam(3, $cta['ctas_p']);
            $pps->bindParam(4, $cta['scs_token']);
            $pps->execute();
            return $pps->rowcount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function  mdlAgregarSocio($scs)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_socios_scs (scs_perfil,scs_correo,scs_wsp,scs_telefono,scs_cuenta) VALUES(?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindParam(1, $scs['scs_perfil']);
            $pps->bindParam(2, $scs['scs_correo']);
            $pps->bindParam(3, $scs['scs_wsp']);
            $pps->bindParam(4, $scs['scs_telefono']);
            $pps->bindParam(5, $scs['scs_cuenta']);
            $pps->execute();
            return $pps->rowcount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlIssetSocioByEmail($scs_correo)
    {
        try {
            //code...
            $sql = "SELECT 1 FROM tbl_socios_scs WHERE scs_correo  = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $scs_correo);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $con = null;
            $pps = null;
        }
    }

    public static function mdlConsultarCuentaByToken($scs_token)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_cuenta_socio_ctas WHERE scs_token = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindParam(1, $scs_token);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlConsultarSocioByCuentaLimit1($scs_cuenta)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_socios_scs WHERE scs_cuenta = ? AND scs_clave IS NULL ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindParam(1, $scs_cuenta);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarSocios($all = 0, $scs_cuenta = "")
    {
        try {
            //code...
            // Con filtro
            if ($all == 0) {
            } // Todos
            else if ($all == 1) {
                $sql = "SELECT * FROM tbl_socios_scs  WHERE scs_cuenta = ?";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindParam(1, $scs_cuenta);
                $pps->execute();
                return $pps->fetchAll();
            }
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarCuentasSocios($all = 0, $ctas_id_padre = "")
    {
        try {
            //code...
            // Con filtro
            if ($all == 0) {
            } // Todos
            else if ($all == 1) {
                $sql = "SELECT * FROM tbl_cuenta_socio_ctas WHERE ctas_id_padre = ?";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindParam(1, $ctas_id_padre);
                $pps->execute();
                return $pps->fetchAll();
            }
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlTerminarRegistroCuenta($ctas)
    {
        try {
            //code...
            $sql = "UPDATE tbl_cuenta_socio_ctas SET ctas_nombre = ? ,ctas_rcf = ?,  ctas_razon_social = ?, scs_token = ? WHERE ctas_id = ? AND scs_token != '' ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctas['ctas_nombre']);
            $pps->bindValue(2, $ctas['ctas_rcf']);
            $pps->bindValue(3, $ctas['ctas_razon_social']);
            $pps->bindValue(4, $ctas['scs_token']);
            $pps->bindValue(5, $ctas['ctas_id']);
            $pps->execute();
            return $pps->rowcount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        }
    }

    public static function mdlTerminarRegistroSocio($scs)
    {
        try {
            //code...
            $sql = "UPDATE tbl_socios_scs SET scs_nombre = ? ,scs_app = ?,  scs_apm = ?, scs_clave = ? WHERE scs_id = ?  ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $scs['scs_nombre']);
            $pps->bindValue(2, $scs['scs_app']);
            $pps->bindValue(3, $scs['scs_apm']);
            $pps->bindValue(4, $scs['scs_clave']);
            $pps->bindValue(5, $scs['scs_id']);
            $pps->execute();
            return $pps->rowcount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        }
    }

    public static function mdlAgregarSucursal($scl)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_sucursales_scl (scl_nombre,scl_cp,scl_estado,scl_municipio,scl_colonia,scl_calle,scl_ne,scl_ni,scl_c1,scl_c2,scl_cuenta,scl_lat,scl_lon,scl_sitio,sc_tel) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindParam(1, $scl['scl_nombre']);
            $pps->bindParam(2, $scl['scl_cp']);
            $pps->bindParam(3, $scl['scl_estado']);
            $pps->bindParam(4, $scl['scl_municipio']);
            $pps->bindParam(5, $scl['scl_colonia']);
            $pps->bindParam(6, $scl['scl_calle']);
            $pps->bindParam(7, $scl['scl_ne']);
            $pps->bindParam(8, $scl['scl_ni']);
            $pps->bindParam(9, $scl['scl_c1']);
            $pps->bindParam(10, $scl['scl_c2']);
            $pps->bindParam(11, $scl['scl_cuenta']);
            $pps->bindParam(12, $scl['scl_lat']);
            $pps->bindParam(13, $scl['scl_lon']);
            $pps->bindParam(14, $scl['scl_sitio']);
            $pps->bindParam(15, $scl['sc_tel']);
            $pps->execute();
            return $pps->rowcount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarSucursales($all = 0, $scl_cuenta = "")
    {
        try {
            //code...
            // Con filtro
            if ($all == 0) {
                $sql = "SELECT * FROM tbl_sucursales_scl";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindParam(1, $scl_cuenta);
                $pps->execute();
                return $pps->fetchAll();
            } // Todos
            else if ($all == 1) {
                $sql = "SELECT * FROM tbl_sucursales_scl  WHERE scl_cuenta = ?";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindParam(1, $scl_cuenta);
                $pps->execute();
                return $pps->fetchAll();
            }
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlIniciarSesion($scs_correo)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_socios_scs WHERE scs_correo = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $scs_correo);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarCuentaSocio($ctas_cta)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_cuenta_socio_ctas WHERE ctas_cta = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctas_cta);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
}
