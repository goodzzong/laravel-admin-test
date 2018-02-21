<?php

namespace App\Admin\Controllers;

use App\Preferences;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use GuzzleHttp\Psr7\Request;

class introMenuController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('대문페이지');
            $content->description('환경설정');

            $cnt = Preferences::where('menu', 'intro')->count();

            if ($cnt > 0) {
                $config = Preferences::where('menu', 'intro')->first();
                $content->body($this->form()->edit($config->id));
            } else {
                $content->body($this->form());
            }


        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    public function create()
    {
        /*
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
        */
    }

    public function update(\Illuminate\Http\Request $request,$id)
    {
        $config = Preferences::find($id);
        //$config->name = $request->input('autoChange');
        $config->menu = $request->input('menu');
        $config->autoChange = $request->input('autoChange');
        $config->changeTime = $request->input('changeTime');
        $config->output = $request->input('output');
        echo $request->input('pageButton');
        //$config->save();
        /*
        $name = $request->input('name');
        $user = Auth::user();

        $user->tasks()->where('id',$id)->update([
            'name' => $name
        ]);
        */
        //return redirect('/tasks');
    }

    protected function grid()
    {
        return Admin::grid(Preferences::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    protected function form()
    {
        return Admin::form(Preferences::class, function (Form $form) {

            //$form->display('id', 'ID');
            $form->hidden('menu')->value('intro');
            $states = [
                'on' => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'NO', 'color' => 'default'],
            ];

            $form->switch('autoChange', '자동전환')->states($states)->default(1);


            $changeTime = [
                '0' => '0.0', '0.1' => 0.1, '0.2' => 0.2, '0.3' => 0.3, '0.4' => 0.4, '0.5' => 0.5, '0.6' => 0.6, '0.7' => 0.7, '0.8' => 0.8,
                '0.9' => 0.9, '1' => 1, '1.1' => 1.1, '1.2' => 1.2, '1.3' => 1.3, '1.4' => 1.4, '1.5' => 1.5, '1.6' => 1.6, '1.7' => 1.7,
                '1.8' => 1.8, '1.9' => 1.9, '2' => 2, '2.1' => 2.1, '2.2' => 2.2, '2.3' => 2.3, '2.4' => 2.4, '2.5' => 2.5, '2.6' => 2.6, '2.7' => 2.7,
                '2.8' => 2.8, '2.9' => 2.9, '3' => 3, '3.1' => 3.1, '3.2' => 3.2, '3.3' => 3.3, '3.4' => 3.4, '3.5' => 3.5, '3.6' => 3.6,
                '3.7' => 3.7, '3.8' => 3.8, '3.9' => 3.9, '4' => 4, '4.1' => 4.1, '4.2' => 4.2, '4.3' => 4.3, '4.4' => 4.4, '4.5' => 4.5,
                '4.6' => 4.6, '4.7' => 4.7, '4.8' => 4.8, '4.9' => 4.9, '5' => 5,
            ];


            $form->select('changeTime', '전환시간')->options($changeTime)->setWidth(2);

            $output = [];
            for ($i = 0; $i <= 999; $i++) {
                $output[$i] = $i;
            }

            $form->select('output', '출력시간')->options($output)->setWidth(2);
            $form->radio('pageButton', '페이지버튼')->options([
                '1' => '예(항상출력)',
                '2' => '예(단, 이미지가 1개만 설정되어 있을 경우 출력 안함)',
                '3' => '아니오'

            ])->default('1');

            $form->disableReset();

            $form->tools(function (Form\Tools $tools) {

                // Disable back btn.
                $tools->disableBackButton();

                // Disable list btn
                $tools->disableListButton();


            });

            $cnt = Preferences::where('menu', 'intro')->count();

            if ($cnt > 0) {
                $config = Preferences::where('menu', 'intro')->first();


                $form->setAction('/admin/intro/config/' . $config->id);

            } else {
                $form->setAction('/admin/intro/config');
            }

        });
    }
}
