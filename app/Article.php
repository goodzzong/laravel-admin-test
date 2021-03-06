<?php

namespace App;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Encore\Admin\Traits\AdminBuilder;
class Article extends Model implements Sortable
{

    use SortableTrait,AdminBuilder;

    protected $fillable = ['title', 'content', 'user_id', 'picture', 'rank', 'display'];
    protected $table = 'admin_articles';

    public $sortable = [
        'order_column_name' => 'rank',
        'sort_when_creating' => true,
    ];

    public static function grid($callback)
    {
        return new Grid(new static, $callback);
    }

    public static function form($callback)
    {
        return new Form(new static, $callback);
    }

}
