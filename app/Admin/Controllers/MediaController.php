<?php

namespace App\Admin\Controllers;

use App\Article;
use App\Media;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\App;

class MediaController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('홍보영상');
            $content->description('리스트');

            $content->body($this->grid());
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

            $content->header('홍보영상');
            $content->description('수정');

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

            $content->header('홍보영상');
            $content->description('등록');

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
        return Admin::grid(Media::class, function (Grid $grid) {

            $grid->model()->ordered();
            $grid->id('ID')->sortable();

            $states = [
                'on' => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'NO', 'color' => 'default'],
            ];

            $grid->released('공개여부')->switch($states);
            $grid->rank('순서')->orderable();
            $grid->media('파일명');

            $grid->title('제목')->ucfirst()->limit(30)->editable();
            $grid->created_at('등록일');
            $grid->updated_at('수정일');


            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('title', '제목');
                $filter->equal('created_at', '등록일')->datetime();
                $filter->between('updated_at', '수정일')->datetime();

            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(Media::class, function (Form $form) {

            $form->hidden('user_id')->value(Admin::user()->id);
            $form->hidden('rank')->value(Media::count());

            $form->display('id', 'ID');

            $form->text('title', '제목')->rules('required', [
                'required' => '제목을 입력해 주세요.',
            ]);

            $form->file('media','동영상');

            $states = [
                'on' => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'NO', 'color' => 'default'],
            ];

            $form->switch('released', '공개여부')->states($states)->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
