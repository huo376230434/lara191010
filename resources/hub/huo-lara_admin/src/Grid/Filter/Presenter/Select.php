<?php

namespace Huojunhao\LaraAdmin\Grid\Filter\Presenter;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid\Filter\Presenter\Presenter;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Select extends \Encore\Admin\Grid\Filter\Presenter\Select
{
    use PresenterCommonTrait;



    /**
     * Build options.
     *
     * @return array
     */
    protected function buildOptions() : array
    {
//        dd(1);
        if (is_string($this->options)) {
            $this->loadRemoteOptions($this->options);
        }

        if ($this->options instanceof \Closure) {
            $this->options = $this->options->call($this->filter, $this->filter->getValue());
        }

        if ($this->options instanceof Arrayable) {
            $this->options = $this->options->toArray();
        }

        if (empty($this->script)) {
            $placeholder = json_encode([
                'id'   => '',
                'text' => trans('admin.choose'),
            ]);

            $configs = array_merge([
                'minimumResultsForSearch' => 10,
                'allowClear'         => true,
            ], $this->config);

            $configs = json_encode($configs);
            $configs = substr($configs, 1, strlen($configs) - 2);

            $this->script = <<<SCRIPT
(function ($){
    $(".{$this->getElementClass()}").select2({
      placeholder: $placeholder,
      $configs
    });
})(jQuery);

SCRIPT;
        }

        Admin::script($this->script);

        return is_array($this->options) ? $this->options : [];
    }

}
