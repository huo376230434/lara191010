<?php

namespace App\HttpTenancy\Facades;




class Tenancy extends \Illuminate\Support\Facades\Facade{
    protected static function getFacadeAccessor()
    {
        return \App\HttpTenancy\Tenancy::class;
    }

}
