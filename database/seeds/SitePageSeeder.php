<?php

use App\Models\General\Page;
use Illuminate\Database\Seeder;

class SitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'slug' => 'about-us',
                'en' => [
                    "title" => "About Us",
                    'body' => "<p>
                    Thank you for giving us your time to read our story. <br>
                    We have experience of making cakes and sweets in general and designing party decorations
                    and everything related to them. <br>
                    So we have decided to accumulate all our experience to help you have an unforgettable
                    celebration.
                </p>
                <p>
                    Thank you for giving us your time to read our story. <br>
                    We have experience of making cakes and sweets in general and designing party decorations
                    and everything related to them. <br>
                    So we have decided to accumulate all our experience to help you have an unforgettable
                    celebration.
                </p>
                <p>
                    We have two parts: <br>
                    The first section is for birthday supplies and special occasions such as anniversary,
                    engagement party, baby shower and other parties.
                </p>
                <p>
                    The second section is about the tools you need to make the best cake and desserts for
                    your party <br>
                    Also, we have video tutorials that explain how to use our products to help you with your
                    mission.
                </p>
                <p>"
                ]
            ],
            [
                'slug' => 'privacy',
                'en' => [
                    'title' => 'PRIVACY POLICY',
                    'body' => "<p>privacy here</p>"
                ]
            ],
            [
                'slug' => 'delivery',
                'en' => [
                    'title' => 'DELIVERY & RETURNS',
                    'body' => "<p>DELIVERY & RETURNS</p>"
                ]
            ],
            [
                'slug' => 'contact-us',
                'en' => [
                    'title' => 'CONTACT US',
                    'body' => '<div>
                    <h2>How can we help?</h2>
                    <h4>
                        Towipi is a completely online business <br>
                        You can contact us via our wesite online chat or Facebook page <br>
                        Customer Service Hours: <br>
                        10:00 AM to 6:00PM <br>
                        Friday: 10:00 AM to 4:00PM <br>
                    </h4>
                    <h2>
                        Need help with your order?
                    </h2>
                    <h4>
                        Visit our help center for <a href="#" class="primary-color"> FAQ</a> and more information about our services.
                    </h4>
                </div>'
                ]
            ],
        ])->map(function ($page) {
            Page::create($page);
        });
    }
}
