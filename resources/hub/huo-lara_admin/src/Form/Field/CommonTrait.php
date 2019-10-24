<?php
namespace Huojunhao\LaraAdmin\Form\Field;

/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 15:48
 */
trait  CommonTrait{
//    public $label_required = false;
//    public $half = false;
//
//
//    public function getPlaceholder()
//    {
//        return '';
////        return $this->placeholder ?: trans('admin.input').' '.$this->label;
//    }
//
//
//    /**
//     * Get view of this field.
//     *
//     * @return string
//     */
////    public function getView()
////    {
////        if (!empty($this->view)) {
////            return $this->view;
////        }
////
////        $class = explode('\\', get_called_class());
////
////        return 'admin::form.'.strtolower(end($class));
////    }
//
//    /**
//     * @param bool $half
//     * @return CommonTrait
//     */
//    public function half()
//    {
//        $this->half = true;
//        return $this;
//    }
//
//    protected function initPlainInput()
//    {
//        if (empty($this->view)) {
//            $this->view = "admin::form.input";
//        }
////        dump($this->view);
//
//    }
//
//
//    public function labelRequired()
//    {
//        $this->label_required = true;
//
//        return $this;
//    }
//
//    public function required($isLabelAsterisked = true)
//    {
////        dd($this->label_required);
//
//        if ($this->label_required) {
//            return $this;
//        }else{
//            return parent::required();
//        }
//
//
//    }
//
//    public function setCustom()
//    {
//        $this->addCustomVariables();
//        $this->setCustomWidth();
//        if ($this->label_required) {
//            $this->setLabelClass(['required_label']);
//        }
//
//
//    }
//
//    public function addCustomVariables()
//    {
//        $this->addVariables([
//            'half' => $this->half
////            'custom_extra_class' => $this->custom_extra_class,
//
//        ]);
//
//    }
//
//
//    public function setCustomWidth()
//    {
//
//        if($this->width['label'] == 2 && $this->width['field'] == 8){
//
//            //如果宽度都是默认值，则设置下面的默认
//            $this->width = [
//                'label' => 2,
//                'field' => 10,
//            ];
//        }
//
//
//    }
//
//
//
//
//
//
//
//
//
//    public function fill($data)
//    {
//        // Field value is already setted.
////        if (!is_null($this->value)) {
////            return;
////        }
//
//        if (is_array($this->column)) {
//
//            foreach ($this->column as $key => $column) {
//                $this->value[$key] = array_get($data, $column);
//            }
//
//            return;
//        }
//        $temp_column = $this->column;
//        $this->value = array_get($data, $temp_column);
//        if (!$this->value) {
//            //如果值为空，且是有点的，就是有关联关系的，那就把关联关系都转成下划线格式的，再试一次
//
//            str_contains($temp_column, '.') && $temp_column=snake_case($temp_column);
//            $this->value = array_get($data, $temp_column);
//
//        }
//
//
//        if (isset($this->customFormat) && $this->customFormat instanceof \Closure) {
//            $this->value = call_user_func($this->customFormat, $this->value);
//        }
//    }
//



}
