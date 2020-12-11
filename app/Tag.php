<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class Tag extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public $sortable = ['id', 'name', 'created_at', 'updated_at'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = Str::slug($name, '-');
    }
}
