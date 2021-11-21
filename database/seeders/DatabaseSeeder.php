<?php namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(TemplatesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
