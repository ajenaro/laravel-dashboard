<?php

namespace App;

use Carbon\Carbon;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Sortable;

    public $sortable = ['id', 'name', 'email', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'state' => 'bool',
        'options' => 'json'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function gravatar()
    {
        return Gravatar::get($this->email);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill')
            ->withTimestamps();
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function lastLogin()
    {
        if($this->logins->count() > 0) {
            return $this->logins()->orderBy('created_at', 'desc')->first()->created_at->format('d/m/yy');
        }

        return '';

    }

    public function team()
    {
        return $this->belongsTo(Team::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        if (empty ($search)) {
            return;
        }

        $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhereHas('team', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
    }

    public function scopeActive($query)
    {
        return $query->with(
            [
                'profile',
                'skills',
            ]
        )
        ->where('active', true);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
