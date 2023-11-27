<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);

        Model::reguard();
    }
}
