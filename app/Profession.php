<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Profession extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public $sortable = ['title'];
}
