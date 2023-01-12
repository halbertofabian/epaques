<?php

class Conexion
{

    static public function conectar()
    {

        try {
            //code...
            $link = new PDO(
                "mysql:host=localhost;dbname=db_empaques",
                "root",
                ""
            );
            //e:r9Rre3$K
            //u203735599_empaques

            $link->exec("set names utf8mb4");

            return $link;
        } catch (PDOException $th) {
            throw $th;
            return false;
        }
    }
}
