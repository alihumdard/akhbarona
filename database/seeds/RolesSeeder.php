<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'display_name' => 'Admin',
            'description' => 'System administrator.',
            'removable' => false
        ]);

        Role::create([
            'name' => 'Editor',
            'display_name' => 'Editor',
            'description' => 'Editor can access permissions. They can access Articles, files,category...',
            'removable' => false
        ]);
        Role::create([
            'name' => 'Comment.Editor',
            'display_name' => 'Comment Editor',
            'description' => 'Comment Editor can access permissions. They can access Articles, files',
            'removable' => false
        ]);
    }
}
