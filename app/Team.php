<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Team extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public $sortable = ['id', 'name', 'created_at', 'updated_at'];
}
