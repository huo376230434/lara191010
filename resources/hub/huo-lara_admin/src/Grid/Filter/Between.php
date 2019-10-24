<?php

namespace Huojunhao\LaraAdmin\Grid\Filter;

use Admin;
use Illuminate\Support\Arr;

class Between extends \Encore\Admin\Grid\Filter\Between
{

    use  FilterCommonTrait;

//
//    protected function setupDatetime($options = [])
//    {
//        $options['format'] = Arr::get($options, 'format', 'YYYY-MM-DD HH:mm');
//        $options['locale'] = Arr::get($options, 'locale', config('app.locale'));
//
//        $startOptions = json_encode($options);
//        $endOptions = json_encode($options + ['useCurrent' => false]);
//
//        $script = <<<EOT
//            $('#{$this->id['start']}').datetimepicker($startOptions);
//            $('#{$this->id['end']}').datetimepicker($endOptions);
//            $("#{$this->id['start']}").on("dp.change", function (e) {
//                $('#{$this->id['end']}').data("DateTimePicker").minDate(e.date);
//            });
//            $("#{$this->id['end']}").on("dp.change", function (e) {
//                $('#{$this->id['start']}').data("DateTimePicker").maxDate(e.date);
//            });
//EOT;
//
//        Admin::script($script);
//    }
}
