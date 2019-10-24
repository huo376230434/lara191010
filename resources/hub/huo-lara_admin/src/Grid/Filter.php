<?php
namespace Huojunhao\LaraAdmin\Grid;

use Encore\Admin\Grid\Filter\AbstractFilter;
use Encore\Admin\Grid\Filter\Group;

/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/2/25
 * Time: 10:10
 */

class Filter extends \Encore\Admin\Grid\Filter{

//
    protected $base_extend_supports = [
        "equal",
        'where',
        'like',
        'between'
    ];

    protected $custom_extend_supports = [
        "cascade",

    ];

    /**
     * Generate a filter object and add to grid.
     *
     * @param string $method
     * @param array  $arguments
     *
     */



    public function __call($method, $arguments)
    {
        if (in_array($method, $this->base_extend_supports)) {
            $className = '\\Huojunhao\\LaraAdmin\\Grid\\Filter\\'.ucfirst($method);
            return $this->addFilter(new $className(...$arguments));
        }

        if (in_array($method, $this->custom_extend_supports)) {
            $className = '\\App\\HttpAdmin\\Extensions\\Grid\\Filter\\'.ucfirst($method);
            return $this->addFilter(new $className(...$arguments));

        }

        if ($filter = $this->resolveFilter($method, $arguments)) {
            return $this->addFilter($filter);
        }
        return $this;
    }

//
//
//    public function urlWithoutFilters()
//    {
//        /** @var Collection $columns */
//        $columns = collect($this->filters)->map->getColumn();
//
//        $pageKey = 'page';
//
//        if ($gridName = $this->model->getGrid()->getName()) {
//            $pageKey = "{$gridName}_{$pageKey}";
//        }
//
//        $columns->push($pageKey);
//
//        $groupNames = collect($this->filters)->filter(function ($filter) {
//            return $filter instanceof Group;
//        })->map(function (AbstractFilter $filter) {
//            return "{$filter->getId()}_group";
//        });
//        $params = $columns->merge($groupNames);
//
//        //添加搜索项的地区联动，使重置按钮可以重置地区//后期再考虑下怎么把其它联动也适配下
//        $params = $params->merge(['filter_province_id','filter_district_id','filter_city_id']);
//        return $this->fullUrlWithoutQuery(
//$params
//        );
//    }
//


}

