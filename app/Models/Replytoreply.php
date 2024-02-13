<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replytoreply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reply_id',
        'comment',
    ];

    public function reply(){
        return $this->belongsTo(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
