<?php

use App\Models\General\Country;
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
            GovernorateSeeder::class,
            FaqSeeder::class,
            SitePageSeeder::class,
            UsersSeeder::class,
        ]);

        Country::whereiso("EG")->update(['enable_shipping' => true]);

        factory(User::class, 400)->create();

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
            ProductCategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}
