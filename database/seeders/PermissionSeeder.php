<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'db-view',
            'create-user',
            'edit-user',
            'delete-user',

            'create-books',
            'edit-books',
            'delete-books',

            'create-club',
            'edit-club',
            'delete-club',

            'create-event',
            'edit-event',
            'delete-event',
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $ceo = Role::create(['name' => 'admin']);
        $ceo->givePermissionTo($permissions);

        $teacher = Role::create(['name'=> 'teacher']);
        $teacher->givePermissionTo($permissions);

        $superAdmin = User::create([
            'name' => 'inSight',
            'email' => 'admin@ex.com',
            'password' => '12345678',
        ]);
        $superAdmin->assignRole('admin');
    }
}
