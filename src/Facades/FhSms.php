<?php

namespace Hmoradian\FhSms\Facades;

use Illuminate\Support\Facades\Facade;

class FhSms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FhSms';
    }
}
