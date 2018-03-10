<?php

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
         //$this->call(UsersTableSeeder::class);
         DB::table('users')->insert([
                'userid'=>str_random(10),
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('111111'),
            ]);

        //Role
         DB::table('roles')->insert([
            'name' => 'Administrator',
            'display_name' => 'Administrator',
            'description' => 'Administrator of the application',
        ]);

        //Role_User
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        //Permissions
        DB::table('permissions')->insert([
            'name' => 'manage-clients',
            'display_name' => 'manage-clients',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage-loans',
            'display_name' => 'manage-loans',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage-users',
            'display_name' => 'manage-users',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage-settings',
            'display_name' => 'manage-settings',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage-accounts',
            'display_name' => 'manage-accounts',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage-applications',
            'display_name' => 'manage-applications',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-permissions',
            'display_name' => 'create-permissions',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'make-deposit',
            'display_name' => 'Make deposit',
            'description' => 'Make Deposit',
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-accounts-clients',
            'display_name' => 'view-accounts-clients',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-accounts-loans',
            'display_name' => 'view-accounts-loans',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-clients',
            'display_name' => 'create-clients',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-clients',
            'display_name' => 'edit-clients',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-clients',
            'display_name' => 'delete-clients',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-loans',
            'display_name' => 'create-loans',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-loans',
            'display_name' => 'edit-loans',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-loans',
            'display_name' => 'delete-loans',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-users',
            'display_name' => 'create-users',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-users',
            'display_name' => 'edit-users',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-users',
            'display_name' => 'delete-users',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'create-roles',
            'display_name' => 'create-roles',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-roles',
            'display_name' => 'edit-roles',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'delete-roles',
            'display_name' => 'delete-roles',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-accounts-client-details',
            'display_name' => 'view-accounts-client-details',
            'description' => 'Administrator of the application',
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-accounts-supplier-details',
            'display_name' => 'view-accounts-supplier-details',
            'description' => 'Administrator of the application',
        ]);

        //Permission_Role
        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 3,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 4,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 5,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 6,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 7,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 8,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 9,
            'role_id' => 1,
        ]);

    }
}
