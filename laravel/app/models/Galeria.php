<?phpclass Galeria extends Eloquent{    protected   $table      = 'galeria';    public      $timestamps = false;    public static function borrarGaleria(){        $path   = public_path().'/galeria/';        return Directorio::VaciarArbolDeDirectorios($path);    }}