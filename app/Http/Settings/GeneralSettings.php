<?php

namespace App\Http\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public bool $site_locked;

    public ?string $site_lock_type;

    public static function group(): string
    {
        return 'general';
    }

    public function unlockSite()
    {
        $this->fill(['site_lock_type' => null, 'site_locked' => false]);
        $this->save();
        return;
    }

    public function makeSiteInMaintenanceMode()
    {
        $this->fill(['site_lock_type' => 'maintenance_mode', 'site_locked' => true]);
        $this->save();
        return;
    }

    public function makeSiteInVacationMode()
    {
        $this->fill(['site_lock_type' => 'vacation_mode', 'site_locked' => true]);
        $this->save();
        return;
    }

    public function isSiteInMaintenanceMode()
    {
        return $this->site_locked && $this->site_lock_type == 'maintenance_mode';
    }

    public function isSiteInVacationMode()
    {
        return $this->site_locked && $this->site_lock_type == 'vacation_mode';
    }
}
