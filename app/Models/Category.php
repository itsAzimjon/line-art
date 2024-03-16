<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'views',
        'type'
    ];

    public function branches(){
        return $this->belongsToMany(Branch::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }
}
