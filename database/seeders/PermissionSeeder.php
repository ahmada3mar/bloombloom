<?php

namespace Database\Seeders;

use App\Models\Basket;
use App\Models\Frame;
use App\Models\Lens;
use App\Models\Price;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Str;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(Permission::class);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            User::class,
            Price::class,
            Lens::class,
            Frame::class,
            Basket::class,
            // ... // List all your Models you want to have Permissions for.
        ]);




        Permission::updateOrCreate([
            'group' => "Frames",
            'name' =>   'view inactive frames',
            'description' => 'Allow the user to view inactive frames'
        ]);

        Permission::updateOrCreate([
            'group' => "Currencies",
            'name' =>   'view all currencies',
            'description' => 'Allow the user to view all currencies'
        ]);


        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            $group = $this->getGroupName($item);
            $permission = $this->getPermissionName($item);

            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'view ' . $permission,
                'description' => 'Allow the user to view a list of ' . strtolower($group) . ' as well as the details'
            ]);
            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'create ' . $permission,
                'description' => 'Allow the user to add new ' . strtolower($group)
            ]);
            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'update ' . $permission,
                'description' => 'Allow the user to update existing ' . strtolower($group)
            ]);
            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'delete ' . $permission,
                'description' => 'Allow the user to delete ' . strtolower($group)
            ]);
            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'destroy ' . $permission,
                'description' => 'Allow the user to destroy ' . strtolower($group)
            ]);
            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'restore ' . $permission,
                'description' => 'Allow the user to restore ' . strtolower($group)
            ]);

            Permission::updateOrCreate([
                'group' => $group,
                'name' =>   'view deleted ' . $permission,
                'description' => 'Allow the user to view deleted ' . strtolower($group)
            ]);
        });

        // Create an Admin and users Role to assign  Permissions
        $admin_role = Role::updateOrCreate(['name' => 'admin']);
        $admin_role->givePermissionTo(Permission::all());

        $user_role = Role::updateOrCreate(['name' => 'user']);
        $user_role->givePermissionTo(["view lenses" , "view frames" , "create baskets"]);

        // Give Admin Role
        $admin = User::firstOrCreate(['email' => "admin@bloombloom.com"], ['password' => bcrypt('P@ssw0rd'), 'name' => 'admin', "currency" => "USD"]);
        $admin->assignRole('admin');

        // Give Admin Role
        $user = User::firstOrCreate(['email' =>'user@bloombloom.com'], ['password' => bcrypt('P@ssw0rd'), 'name' => 'user', "currency" => "USD"]);
        $user->assignRole('user');
    }

    /**
     * Get group name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getGroupName($class)
    {
        return Str::plural(Str::title(Str::snake(class_basename($class), ' ')));
    }

    /**
     * Get permission name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getPermissionName($class)
    {
        return Str::plural(Str::snake(class_basename($class), ' '));
    }
}
