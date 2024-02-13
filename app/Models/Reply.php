<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'forum_id',
        'comment',
    ];

    public function forum(){
        return $this->belongsTo(Forum::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replulikes(){
        return $this->hasMany(Replylike::class);
    }

    public function replytoreplies(){
        return $this->hasMany(Replytoreply::class);
    }
}
