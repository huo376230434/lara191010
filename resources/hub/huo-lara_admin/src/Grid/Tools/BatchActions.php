<?php

namespace Huojunhao\LaraAdmin\Grid\Tools;

use Encore\Admin\Admin;
use Illuminate\Support\Collection;

class BatchActions extends \Encore\Admin\Grid\Tools\BatchActions
{
//    protected $isHoldSelectAllCheckbox = false;
//
//    protected function appendDefaultAction()
//    {
//        $this->add(new BatchDelete(trans('admin.batch_delete')));
//    }
//
//
//    public function render()
//    {
//        if (!$this->enableDelete) {
//            $this->actions->shift();
//        }
//
//        if ($this->actions->isEmpty()) {
//            return '';
//        }
//
//        $this->setUpScripts();
//
//        $data = [
//            'actions'                 => $this->actions,
//            'selectAllName'           => $this->grid->getSelectAllName(),
//            'isHoldSelectAllCheckbox' => $this->isHoldSelectAllCheckbox,
//        ];
//
//        return view('admin::grid.batch-actions', $data)->render();
//    }


}
