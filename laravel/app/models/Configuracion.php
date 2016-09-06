<?phpclass Configuracion extends Eloquent {    protected   $table          =   "configuraciones";    public      $timestamps     =   false;    private static $rules          =    array(        'fecha_ini'                =>   array('sometimes', 'required', 'date', 'before:fecha_fin'),        'fecha_fin'                =>   array('sometimes', 'required', 'date'),        'alias'                    =>   array('sometimes', 'required', 'max:255'),        'tarifa_minima'            =>   array('required', 'numeric', 'min:0', 'digits_between:1,17'),        'precio_noche_adicional'   =>   array('required', 'numeric', 'min:0', 'digits_between:1,17'),        'precio_semana'            =>   array('required', 'numeric', 'min:0', 'digits_between:1,17'),        'noches_minimas'           =>   array('required', 'integer', 'min:1', 'max:10')    );    public static function validate($input){        $validator  =   Validator::make(            $input,            self::$rules        );        return $validator;    }}