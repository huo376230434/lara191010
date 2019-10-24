<?php
/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-10-14
 * Time: 17:03
 */
namespace App\HttpTenancy\Controllers\Base;
use App\Http\Controllers\Controller;
use App\HttpTenancy\Extensions\Layout\Content;
use Encore\Admin\Controllers\HasResourceActions;

class TenancyBaseController extends Controller{


    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Title';

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
//        'index'  => 'Index',
//        'show'   => 'Show',
//        'edit'   => 'Edit',
//        'create' => 'Create',
    ];

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title;
    }


    public function __construct()
    {
        if ($init_title = $this->initTitle()) {
            $this->title = $init_title;
        }
    }



    protected function initTitle()
    {
        return '';
    }

    protected function actionLog($msg)
    {

    }


    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }


    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }


    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }




}
