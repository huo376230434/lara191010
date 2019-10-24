<?php

namespace Huojunhao\LaraAdmin\BaseExtends;



class AdminSelector
{

    public static function createBtn()
    {
        return ".custom-grid .grid-create-btn [title=\"新增\"]";
    }


    public static function formSubmitBtn()
    {
        return "#pjax-container form [type=\"submit\"]";
    }

    public static function simpleSubmitBtn()
    {
        return " form [type=\"submit\"]";

    }


    public static function grid()
    {
        return '.custom-grid';
    }

    public static function duskSelectorData($data_dusk)
    {
        return '[data-dusk='.$data_dusk.']';
    }

    public static   function editBtn($last = false)
    {
        $type = $last ? "last" : "first";

        return ".custom-grid table tr:$type-child > .column-__actions__   .grid-row-edit";
    }

    public static   function deleteBtn($last = false)
    {
        $type = $last ? "last" : "first";

        return ".custom-grid table tr:$type-child > .column-__actions__   .grid-row-delete";
    }




    public static   function showBtn($last = false)
    {
        $type = $last ? "last" : "first";

        return ".custom-grid table tr:$type-child > .column-__actions__   .grid-row-view";
    }


    public static function gridActionBtn($suffix,$last=false)
    {
        $type = $last ? "last" : "first";

        return ".custom-grid table tr:$type-child > .column-__actions__    " . $suffix;

    }

    public static function swalConfirmBtn()
    {
        return ".swal2-container .swal2-actions .swal2-confirm";
        
    }



    public static function swalCancelBtn()
    {
        return ".swal2-container .swal2-actions .swal2-cancel";

    }

    public static function swalTitle()
    {
        return ".swal2-title";
    }

    public static function showPanel()
    {
        return ".custom-show";
    }

    public static function showPanelListBtn()
    {
        return ".custom-show  .btn[title=\"列表\"]";
    }



}
