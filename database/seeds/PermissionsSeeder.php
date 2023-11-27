<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'Admin')->first();

        $permissions[] = Permission::create([
            'name' => 'users.manage',
            'display_name' => 'Manage Users',
            'description' => 'Manage users and their sessions.',
            'removable' => false
        ]);
        $permissions[] = Permission::create([
            'name' => 'article.manage',
            'display_name' => 'Manage Article',
            'description' => 'Manage system Articles.',
            'removable' => false
        ]);
        $permissions[] = Permission::create([
            'name' => 'article.pending',
            'display_name' => 'Article Pending',
            'description' => 'Article is pending when it was add in this permission',
            'removable' => false
        ]);
        $permissions[] = Permission::create([
            'name' => 'category.manage',
            'display_name' => 'Manage Categories',
            'description' => 'Manage system Category.',
            'removable' => false
        ]);
        $permissions[] = Permission::create([
            'name' => 'file.manage',
            'display_name' => 'Manage File',
            'description' => 'Manage system Files.',
            'removable' => false
        ]);
        $permissions[] = Permission::create([
            'name' => 'comment.manage',
            'display_name' => 'Manage Comment',
            'description' => 'Manage system comments.',
            'removable' => false
        ]);
        $permissions[] = Permission::create([
            'name' => 'roles.manage',
            'display_name' => 'Manage Roles',
            'description' => 'Manage system roles.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'permissions.manage',
            'display_name' => 'Manage Permissions',
            'description' => 'Manage role permissions.',
            'removable' => false
        ]);

        $adminRole->attachPermissions($permissions);
    }
}
