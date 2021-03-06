<?php

namespace Zxg321\Zmall\Controllers\Store;

use Zxg321\Zmall\Database\Store\Category;
//use Zxg321\Zmall\AdminAudit;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Auth\Database\Menu;
use Illuminate\Support\Facades\Cache;
//use Encore\Admin\Auth\Database\Administrator;
class CategoryController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    //protected $code=['index'=>'网站首页','newsindex'=>'新闻首页','newslist'=>'新闻列表','content'=>'内容显示'];
    protected $title='店铺分类';
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->title);
            $content->description($this->title.'设置');
            $content->body(Category::tree());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('商品分类');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('商品分类');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Category::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at('建立时间');
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {
           
                $form->display('id', '序号');
                $form->select('parent_id', '上级菜单')->options(Category::selectOptions());
                $form->text('title', '标题');
                $form->number('sort_order', '排序');
                $form->hasMany('parent','下一级商品菜单', function (Form\NestedForm $form) {
                    $form->text('title', '标题');
                    $form->number('sort_order', '排序');
                });
            


        });
    }
}
