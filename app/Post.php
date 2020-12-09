<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use Sortable;

    public $sortable = ['title', 'excerpt', 'published_at'];

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function setPublishedAtAttribute( $published_at )
    {
        $this->attributes['published_at'] = $published_at
            ? Carbon::createFromFormat('d/m/Y', $published_at)->format('Y-m-d')
            : null;
    }
}
