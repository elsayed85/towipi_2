<?php

namespace App\Traits;

trait LivewireLocale
{
    public $livewireLocale;

    public function mount()
    {
        $this->livewireLocale = app()->getLocale();
    }
}
