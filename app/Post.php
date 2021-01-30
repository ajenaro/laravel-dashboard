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

    protected static function boot()
    {
        parent::boot();

        static::deleting(
            function ($post) {
                $post->tags()->detach();
                $post->photos->each->delete();
            }
        );
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $post = static::query()->create($attributes);

        $post->generateUrl();

        return $post;
    }

    public function generateUrl()
    {
        $url = Str::slug($this->title, '-');

        if ($this::where('url', $url)->exists()) {
            $url = "{$url}-{$this->id}";
        }

        $this->url = $url;

        $this->save();
    }
}
