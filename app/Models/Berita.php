<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Berita extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug_title',
        'description',
        'views',
        'current_date',
        'image_url',
        'userid',
        'category_id'
    ];

    /**
     * Get the user that owns the Berita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    /**
     * Get the user that owns the Berita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }

    /**
     * Get all of the comments for the Berita
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komentar(): HasMany
    {
        return $this->hasMany(Comment::class, 'beritaid', 'id');
    }
}
