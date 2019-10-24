<?php
namespace Huojunhao\LaraAdmin;
use Closure;
use Encore\Admin\Form\Field;
use Huojunhao\LaraAdmin\Exception\Handler;
use Huojunhao\LaraAdmin\Form\Builder;
use Huojunhao\LaraAdmin\Form\Field\Date;
use Huojunhao\LaraAdmin\Form\Field\DateRange;
use Huojunhao\LaraAdmin\Form\Field\Datetime;
use Huojunhao\LaraAdmin\Form\Field\DatetimeRange;
use Huojunhao\LaraAdmin\Form\Field\Display;
use Huojunhao\LaraAdmin\Form\Field\Email;
use Huojunhao\LaraAdmin\Form\Field\File;
use Huojunhao\LaraAdmin\Form\Field\Html;
use Huojunhao\LaraAdmin\Form\Field\Image;
use Huojunhao\LaraAdmin\Form\Field\Mobile;
use Huojunhao\LaraAdmin\Form\Field\MultipleSelect;
use Huojunhao\LaraAdmin\Form\Field\Number;
use Huojunhao\LaraAdmin\Form\Field\Password;
use Huojunhao\LaraAdmin\Form\Field\Radio;
use Huojunhao\LaraAdmin\Form\Field\Select;
use Huojunhao\LaraAdmin\Form\Field\Text;
use Huojunhao\LaraAdmin\Form\Field\Textarea;
use Huojunhao\LaraAdmin\Form\Field\Time;
use Huojunhao\LaraAdmin\Form\Field\TimeRange;
use Huojunhao\LaraAdmin\Form\Field\Url;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;


/**
 * Class Form.
 *
 * @method Field\Text           text($column, $label = '')
 * @method Field\Checkbox       checkbox($column, $label = '')
 * @method Field\Radio          radio($column, $label = '')
 * @method Field\Select         select($column, $label = '')
 * @method Field\MultipleSelect multipleSelect($column, $label = '')
 * @method Field\Textarea       textarea($column, $label = '')
 * @method Field\Hidden         hidden($column, $label = '')
 * @method Field\Id             id($column, $label = '')
 * @method Field\Ip             ip($column, $label = '')
 * @method Field\Url            url($column, $label = '')
 * @method Field\Color          color($column, $label = '')
 * @method Field\Email          email($column, $label = '')
 * @method Field\Mobile         mobile($column, $label = '')
 * @method Field\Slider         slider($column, $label = '')
 * @method Field\File           file($column, $label = '')
 * @method Field\Image          image($column, $label = '')
 * @method Field\Date           date($column, $label = '')
 * @method Field\Datetime       datetime($column, $label = '')
 * @method Field\Time           time($column, $label = '')
 * @method Field\Year           year($column, $label = '')
 * @method Field\Month          month($column, $label = '')
 * @method Field\DateRange      dateRange($start, $end, $label = '')
 * @method Field\DateTimeRange  datetimeRange($start, $end, $label = '')
 * @method Field\TimeRange      timeRange($start, $end, $label = '')
 * @method Field\Number         number($column, $label = '')
 * @method Field\Currency       currency($column, $label = '')
 * @method Field\HasMany        hasMany($relationName, $label = '', $callback)
 * @method Field\SwitchField    switch($column, $label = '')
 * @method Field\Display        display($column, $label = '')
 * @method Field\Rate           rate($column, $label = '')
 * @method Field\Divider        divider($title = '')
 * @method Field\Password       password($column, $label = '')
 * @method Field\Decimal        decimal($column, $label = '')
 * @method Field\Html           html($html, $label = '')
 * @method Field\Tags           tags($column, $label = '')
 * @method Field\Icon           icon($column, $label = '')
 * @method Field\Embeds         embeds($column, $label = '', $callback)
 * @method Field\MultipleImage  multipleImage($column, $label = '')
 * @method Field\MultipleFile   multipleFile($column, $label = '')
 * @method Field\Captcha        captcha($column, $label = '')
 * @method Field\Listbox        listbox($column, $label = '')
 * @method Field\Table          table($column, $label, $builder)
 * @method Field\Timezone       timezone($column, $label = '')
 * @method Field\KeyValue       keyValue($column, $label = '')
 * @method Field\ListField      list($column, $label = '')
 */
class Form extends \Encore\Admin\Form{


    public function __construct($model, Closure $callback = null)
    {

        $this->model = $model;

        $this->builder = new Builder($this);

        $this->initLayout();

        if ($callback instanceof Closure) {
            $callback($this);
        }

        $this->isSoftDeletes = in_array(SoftDeletes::class, class_uses_deep($this->model));

        $this->callInitCallbacks();


//新增逻辑
        $this->addDefaultFields();


    }

//

    public function plainForm()
    {
        $this->builder()->setView("admine::form.plain_form");
    }

    protected function addDefaultFields()
    {
        if ($redirect_url = request('_redirect_url')) {
            $this->hidden('_redirect_url')->value($redirect_url);
            $this->ignore('_redirect_url');
        }
    }


//    public static function registerCustomBuilds()
//    {
//        $admin_base_forms = require __DIR__ . '/BaseExtends/Form/config.php';
//        $admin_extend_forms = require __DIR__ . "/Custom/Form/config.php";
//        $admin_extend_forms = array_merge($admin_base_forms, $admin_extend_forms);
//        foreach ($admin_extend_forms as $abstract => $class) {
//            \App\Admin\Extensions\Form::extend($abstract, $class);
//        }
//    }



    protected $custom_fields = [
        'text' => Text::class,
        'select' => Select::class,
        'mobile' => Mobile::class,
        'file' => File::class,
        'password' => Password::class,
        'image' => Image::class,
        'url' => Url::class,
        'textarea' => Textarea::class,
        'date'           => Date::class,
        'dateRange'      => DateRange::class,
        'datetime'       => Datetime::class,
        'dateTimeRange'  => DatetimeRange::class,
        'display'        => Display::class,
        'email'          => Email::class,
        'multipleSelect' => MultipleSelect::class,
        'number'         => Number::class,
        'radio'          => Radio::class,
        'time'           => Time::class,
        'timeRange'      => TimeRange::class,
        'html'           => Html::class,
    ];





    public function render()
    {
        try {
            return $this->builder->render();
        } catch (\Exception $e) {
            return Handler::renderException($e);
        }
    }


    public function __call($method, $arguments)
    {

        if (key_exists($method, $this->custom_fields)) {
            $className = $this->custom_fields[$method];
            $column =  Arr::get($arguments, 0, ''); //[0];
            $element = new $className($column, array_slice($arguments, 1));
            $this->pushField($element);
            return $element;
        }

        return   parent::__call($method, $arguments);
    }



    protected function redirectAfterSaving($resourcesPath, $key)
    {
        if (request('after-save') == 1) {
            // continue editing
            $url = rtrim($resourcesPath, '/')."/{$key}/edit";
        } elseif (request('after-save') == 2) {
            // continue creating
            $url = rtrim($resourcesPath, '/').'/create';
        } elseif (request('after-save') == 3) {
            // view resource
            $url = rtrim($resourcesPath, '/')."/{$key}";
        } elseif($redirect_url = request('_redirect_url')) {
            $url = $redirect_url;
        }else {
            $url = request(Builder::PREVIOUS_URL_KEY) ?: $resourcesPath;
        }

        admin_toastr(trans('admin.save_succeeded'));

        return redirect($url);
    }


}
