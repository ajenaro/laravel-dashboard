<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = ['id'];

    public $sortable = ['job_title', 'website', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
