<?php

namespace Huojunhao\LaraAdmin\Form\Field;

use Encore\Admin\Form\Field\File as ParentFile;

class File extends ParentFile
{
    use CommonTrait;

//    protected function initialPreviewConfig()
//    {
//        return [
////            ['caption' => basename($this->value), 'key' => 0,''],
//            ['showCaption' => false, 'key' => 0],
//        ];
//    }
//
//
//
//
//    public function allowedFileExtensions($allow = ['jpg','jpeg','png','gif'])
//    {
//        $this->options(['allowedFileExtensions' =>$allow]);
//    }
//
//
//
//    public function setMaxFileSize($m_size=2)
//    {
//
//        $this->options(['maxFileSize' =>$m_size * 1024]);
//
//    }
//
//    public function hideThumbnailContent()
//    {
//        $this->options(['hideThumbnailContent'=> true]);
//
//    }
//
//
//    protected function setupDefaultOptions()
//    {
//        $defaults = [
//            'language'=> 'zh',
//            'overwriteInitial'     => false,
//            'initialPreviewAsData' => true,
//            'browseLabel'          => trans('admin.browse'),
//            'cancelLabel'          => trans('admin.cancel'),
//            'showCancel'           => false,
//            'showUpload'           => false,
//            'dropZoneEnabled'      => false,
//            'deleteExtraData'      => [
//                $this->formatName($this->column) => static::FILE_DELETE_FLAG,
//                static::FILE_DELETE_FLAG         => '',
//                '_token'                         => csrf_token(),
//                '_method'                        => 'PUT',
//            ],
//        ];
//
//        if ($this->form instanceof Form) {
//            $defaults['deleteUrl'] = $this->form->resource().'/'.$this->form->model()->getKey();
//        }
//
//        $defaults = array_merge($defaults, ['fileActionSettings' => $this->fileActionSettings]);
//
//        $this->options($defaults);
//    }
//
//
//    /**
//     * Render file upload field.
//     *
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function render()
//    {
//        $this->options(['overwriteInitial' => true]);
//        $this->setupDefaultOptions();
//
//        if (!empty($this->value)) {
//            $this->attribute('data-initial-preview', filter_var($this->preview(), FILTER_VALIDATE_URL));
//            $this->attribute('data-initial-caption', $this->initialCaption($this->value));
//
//            $this->setupPreviewOptions();
//        }
//
////        $this->hideThumbnailContent();
////        dd($this->options);
//        $options = json_encode($this->options);
//
//        $this->script = <<<EOT
//
//$("input{$this->getElementClassSelector()}").fileinput({$options});
//
//EOT;
//
//        return parent::render();
//    }
}
