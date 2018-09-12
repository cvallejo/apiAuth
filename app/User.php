<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $appends = ['avatar_url'];
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'active', 'activation_token', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token', 'activation_token',
    ];

    public function getAvatarUrlAttribute()
    {
        return \Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }
}
