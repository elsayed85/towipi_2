<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            FaqSeeder::class,
            SitePageSeeder::class,
            UsersSeeder::class
        ]);

        factory(User::class , 40)->create();

    }
}
