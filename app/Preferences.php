<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    protected $fillable = [
        "menu",
        "autoChange",
        "changeTime",
        "pageButton",
        "output",
    ];
    protected $table = "admin_preferences";


}
