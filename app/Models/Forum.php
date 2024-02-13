<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tag_id',
        'title',
        'image',
        'description',
        'views',
    ];

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function forumlikes(){
        return $this->hasMany(Forumlike::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    
}
