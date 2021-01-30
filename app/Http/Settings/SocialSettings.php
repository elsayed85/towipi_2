<?php

namespace App\Http\Settings;

use Spatie\LaravelSettings\Settings;

class SocialSettings extends Settings
{
    public ?string $facebook = null;
    public ?string $instagram = null;
    public ?string $youtube = null;
    public ?string $pinterest =  null;
    public ?string $twitter =  null;
    public ?string $snapchat =  null;
    public ?string $tiktok =  null;

    public static function group(): string
    {
        return 'social';
    }
}
