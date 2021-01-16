<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Administrator',
            'description' => 'can do everything'
        ]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'User is allowed to manage and edit other users',
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'User',
        ]);


        // create first super admin

        $superAdmin = User::create([
            'name' => 'super admin user',
            'email' => "super@gmail.com",
            'password' => Hash::make("password"),
            "country_id" => 63
        ]);

        $superAdmin->attachRoles(['super_admin']);
        $superAdmin->markEmailAsVerified();


        // create first admin

        $admin = User::create([
            'name' => 'admin',
            'email' => "admin@gmail.com",
            'password' => Hash::make("password"),
            "country_id" => 63
        ]);

        $admin->attachRoles(['admin']);
        $admin->markEmailAsVerified();


        // create first user

        $user = User::create([
            'name' => 'user',
            'email' => "user@gmail.com",
            'password' => Hash::make("password"),
            "country_id" => 63
        ]);

        $user->attachRoles(['user']);
    }
}
