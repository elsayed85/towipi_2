<?php

use App\Models\Permission;
use App\Models\Product\Category;
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
            SiteSettingsSeeder::class,
            LaratrustSeeder::class,
            CountrySeeder::class,
            FaqSeeder::class,
            SitePageSeeder::class,
            UsersSeeder::class,
        ]);

        factory(User::class, 40)->create();

        Category::create([
            'en' => [
                'name' => "cake tools"
            ]
        ]);

        Category::create([
            'en' => [
                'name' => "Party Supplies"
            ]
        ]);

        $this->call([
            CharacterSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}
