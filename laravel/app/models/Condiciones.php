<?phpclass Condiciones extends Eloquent {    protected   $table      = 'condiciones';    public      $timestamps =   false;    private static $rules       = array(        'contenido'     =>  array('required')    );    private static $messages    = array(        'required'          =>  'Es necesario escribir unas condiciones de uso.'    );    public static function validate($input){        return Validator::make(            $input,            self::$rules,            self::$messages        );    }}