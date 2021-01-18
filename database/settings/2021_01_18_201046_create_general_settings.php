<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Towipi');
        $this->migrator->add('general.site_locked', false);
        $this->migrator->add('general.site_lock_type' , null);
    }
}
