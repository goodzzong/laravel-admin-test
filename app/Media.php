<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Media extends Model implements Sortable
{
    use SortableTrait,AdminBuilder;

    protected $fillable = [
        'user_id',
        'title',
        'media',
        'rank',
        'released'
    ];
    protected $table = 'admin_medias';

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
