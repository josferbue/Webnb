<?php

class Directorio{

    public static function VaciarArbolDeDirectorios($path, $borrarDirectorioActual = false){

        $path = rtrim(strval($path). '/' );
        $d = dir($path);

        if(!$d){

            return false;
        }

        while (($current = $d->read()) !== false){

            if($current === '.' || $current === '..')
                continue;

            $file = $d->path . '/' . $current;

            if(is_dir($file))
                self::VaciarArbolDeDirectorios($file, $borrarDirectorioActual);

            if(is_file($file))
                unlink($file);
        }

        if($borrarDirectorioActual){

            rmdir($d->path);
        }

        $d->close();
        return true;
    }

    public static function create($ubicacion, $new){

        return mkdir($ubicacion.'/'.$new);
    }

    public static function delete($ubicacion, $name){

        $path   = $ubicacion.'/'.$name;

        return self::VaciarArbolDeDirectorios($path, true);
    }
}