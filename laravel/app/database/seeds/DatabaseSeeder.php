<?phpclass DatabaseSeeder extends Seeder {    public function run()    {        Eloquent::unguard();        DB::statement('SET FOREIGN_KEY_CHECKS=0');        // Add calls to Seeders here        $this->call('UsersTableSeeder');        //$this->call('EntradasTableSeeder');        $this->call('RolesTableSeeder');        $this->call('PermissionsTableSeeder');        $this->call('CarpetasTableSeeder');        //$this->call('EnlacesTableSeeder');        $this->call('ConfiguracionesTableSeeder');        $this->call('ReservasTableSeeder');        $this->call('ComentariosTableSeeder');        $this->call('UbicacionTableSeeder');        $this->call('AnfitrionTableSeeder');        DB::statement('SET FOREIGN_KEY_CHECKS=1');    }}