<?php
namespace App\HttpTenancy;


use Encore\Admin\Admin;
use Illuminate\Support\Facades\Auth;

/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/2/18
 * Time: 15:42
 */
class Tenancy extends Admin {


    public function bootstrap()
    {
        $this->fireBootingCallbacks();

        require config('tenancy.bootstrap', admin_path('bootstrap.php'));

//        dd(4);
        $this->addAdminAssets();

        $this->fireBootedCallbacks();
    }

    public function guard()
    {
        $guard = config('tenancy.auth.guard') ?: 'tenancy';

        return Auth::guard($guard);
    }


    public function user()
    {
        return $this->guard()->user();
    }


    public function menu()
    {

        return [
          [
              'id' => 1, 'parent_id' => 0,'title' => "Tenancy管理","icon" => 'fa-users','uri' => "auth/users"
          ]
        ];
    }
}
