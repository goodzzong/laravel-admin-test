<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class News extends Model implements Sortable
{
    use SortableTrait, AdminBuilder;
    protected $fillable = ['title', 'user_id', 'rank', 'released'];
    protected $table = 'admin_news';

    public $sortable = [
        'order_column_name' => 'rank',
        'sort_when_creating' => true,
    ];
}
