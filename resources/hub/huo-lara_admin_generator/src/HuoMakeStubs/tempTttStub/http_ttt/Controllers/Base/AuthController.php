<?php

namespace App\HttpTenancy\Controllers\Base;

use App\HttpTenancy\Facades\Tenancy;
use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Huojunhao\LaraAdmin\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends BaseAuthController
{
    protected $loginView = 'tenancy::login';

    protected function guard()
    {
//        dd(234);
        return Tenancy::guard();
    }


    /**
     * User logout.
     *
     * @return Redirect
     */
    public function getLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(config('tenancy.route.prefix'));
    }


    protected function settingForm()
    {
        $class = config('tenancy.database.users_model');

        $form = new Form(new $class());

        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.name'))->rules('required');
        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });

        return $form;
    }


    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : config('tenancy.route.prefix');
    }

}
