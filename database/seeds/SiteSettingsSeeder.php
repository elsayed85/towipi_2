<?php

use App\Http\Settings\SocialSettings;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social = new SocialSettings();
        $social->youtube = "youtube.com";
        $social->instagram = "instagram.com";
        $social->pinterest = "pinterest.com";
        $social->facebook = "facebook.com";
        $social->twitter = "twitter.com";
        $social->tiktok = "tiktok.com";
        $social->snapchat = "snapchat.com";
        $social->save();
    }
}
