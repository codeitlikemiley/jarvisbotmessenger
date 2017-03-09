<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SetupWizard extends Facade {

    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'SetupWizard';
    }
}