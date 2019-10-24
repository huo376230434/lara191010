<?php

namespace Huojunhao\LaraAdmin\Grid;

use Encore\Admin\Grid;

class Model extends Grid\Model
{

//
//    /**
//     * @throws \Exception
//     *
//     * @return Collection
//     */
//    protected function get()
//    {
//        if ($this->model instanceof LengthAwarePaginator) {
//            return $this->model;
//        }
//
//
//        if ($this->relation) {
//            $this->model = $this->relation->getQuery();
//        }
//
//        $this->setSort();
//        $this->setPaginate();
//
//        $this->queries->unique()->each(function ($query) {
//            $this->model = call_user_func_array([$this->model, $query['method']], $query['arguments']);
//        });
//
//        if ($this->model instanceof Collection) {
//            return $this->model;
//        }
//
//        if ($this->model instanceof LengthAwarePaginator) {
//            $this->handleInvalidPage($this->model);
//
//            return $this->model->getCollection();
//        }
//        if ($this->model instanceof Paginator) {
//            $this->handleInvalidSimplePage($this->model);
//
//            return $this->model->getCollection();
//        }
//
//        throw new \Exception('Grid query error');
//    }
//
//
//    protected function handleInvalidSimplePage(Paginator $paginator)
//    {
//        dd($paginator);
//        if ($paginator->lastPage() && $paginator->currentPage() > $paginator->lastPage()) {
//            $lastPageUrl = Request::fullUrlWithQuery([
//                $paginator->getPageName() => $paginator->lastPage(),
//            ]);
//
//            Pjax::respond(redirect($lastPageUrl));
//        }
//    }

}
