<?phpclass Descripcion extends Eloquent {    protected   $table      = 'descripcion';    public      $timestamps =   false;    private static $rules       = array(        'titulo'        => array('required', 'max:255'),        'descripcion'   => array('required'),        'capacidad'     => array('required', 'integer', 'min:1', 'max:25'),        'dormitorios'   => array('required', 'integer', 'min:1', 'max:20'),        'banyos'        => array('required', 'integer', 'min:1', 'max:20'),        'camas'         => array('required', 'integer', 'min:1', 'max:25')    );    public static function validate($input){        return Validator::make(            $input,            self::$rules        );    }}