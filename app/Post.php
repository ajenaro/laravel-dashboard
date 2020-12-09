<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use Sortable;

    public $sortable = ['title', 'excerpt', 'published_at'];

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function setPublishedAtAttribute( $value )
    {
        $this->attributes['published_at'] = $value
            ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d')
            : null;
    }

    public function getExcerptResumeAttribute($value): string
    {
        return Str::limit($this->attributes['excerpt'], 50, '...');
    }
}
