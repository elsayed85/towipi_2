<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSocailSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('social.facebook', null);
        $this->migrator->add('social.instagram', null);
        $this->migrator->add('social.youtube', null);
        $this->migrator->add('social.pinterest', null);
    }
}
