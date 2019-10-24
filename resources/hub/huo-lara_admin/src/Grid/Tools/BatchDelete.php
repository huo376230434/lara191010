<?php

namespace Huojunhao\LaraAdmin\Grid\Tools;

class BatchDelete extends \Encore\Admin\Grid\Tools\BatchDelete
{
//
//    /**
//     * Script of batch delete action.
//     */
//    public function script()
//    {
//        $trans = [
//            'delete_confirm' => trans('admin.delete_confirm'),
//            'confirm'        => trans('admin.confirm'),
//            'cancel'         => trans('admin.cancel'),
//        ];
//
//        return <<<EOT
//
//$('{$this->getElementClass()}').on('click', function() {
//
//    var id = {$this->grid->getSelectedRowsName()}().join() ;
//    id = id ? id : 0;
//    swal({
//        title: "{$trans['delete_confirm']}",
//        type: "warning",
//        showCancelButton: true,
//        confirmButtonColor: "#DD6B55",
//        confirmButtonText: "{$trans['confirm']}",
//        showLoaderOnConfirm: true,
//        cancelButtonText: "{$trans['cancel']}",
//        preConfirm: function() {
//            return new Promise(function(resolve) {
//                $.ajax({
//                    method: 'post',
//                    url: '{$this->resource}/' + id,
//                    data: {
//                        _method:'delete',
//                        _token:'{$this->getToken()}'
//                    },
//                    success: function (data) {
//                        $.pjax.reload('#pjax-container');
//
//                        resolve(data);
//                    }
//                });
//            });
//        }
//    }).then(function(result) {
//        var data = result.value;
//        if (typeof data === 'object') {
//            if (data.status) {
//                swal(data.message, '', 'success');
//            } else {
//                swal(data.message, '', 'error');
//            }
//        }
//    });
//});
//
//EOT;
//    }
}
