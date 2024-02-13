<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_model',
        'category_id',
        'photo',
        'file',
        'title',
        'price',
        'description',
        'downloads',
        'view',
        'doc_number',
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function downloads(){
        return $this->hasMany(Download::class);
    }

    public function raties(){
        return $this->hasMany(Rate::class);
    }

    public function saves(){
        return $this->hasMany(Save::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
