<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'age',
        'gender',
        'region',
        'job',
        'experience', 
        'photo',
        'email',
        'phone',
        'verify_otp',
        'password',
        'credit',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function saves(){
        return $this->hasMany(Save::class);
    }

    public function downloads(){
        return $this->hasMany(Download::class);
    }

    public function raties(){
        return $this->hasMany(Rate::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function replylikes(){
        return $this->hasMany(Replylike::class);
    }

    public function replytoreplies(){
        return $this->hasMany(Replytoreply::class);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }

    public function forumlikes(){
        return $this->hasMany(Forumlike::class);
    }
}
