<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replylike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reply_id',
    ];

    public function reply(){
        return $this->belongsTo(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
