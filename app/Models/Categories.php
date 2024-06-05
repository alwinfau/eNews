<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;
    protected $fillable=[
        'categoryname',
        'slug_categoryname',
        'userid',
    ];

    public function user(){
        return $this->belongsTo(User::class,'userid','id');
    }

    /**
     * Get all of the comments for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'category_id', 'id');
    }
}
