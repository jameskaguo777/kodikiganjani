<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'web access']);
        Permission::create(['name' => 'api access']);
        // Permission::create(['name' => 'web api access']);
        

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('api access');
        

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('web access');
        

        $role3 = Role::create(['name' => 'super-admin']);
        $role3->givePermissionTo('web access');
        $role3->givePermissionTo('api access');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Kodi Kiganjani',
            'email' => 'memtechnologiestz@gmail.com',
            'password' => Hash::make('secret@1952KODI')
        ]);
        $user->assignRole($role3);
    }
}
