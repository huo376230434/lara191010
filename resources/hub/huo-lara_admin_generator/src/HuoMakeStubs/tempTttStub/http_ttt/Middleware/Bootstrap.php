<?php

namespace App\HttpTenancy\Middleware;


use App\HttpTenancy\Facades\Tenancy;
use Closure;
use Illuminate\Http\Request;

class Bootstrap extends \Encore\Admin\Middleware\Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        Tenancy::bootstrap();

        return $next($request);
    }
}
