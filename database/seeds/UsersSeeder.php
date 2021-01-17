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
