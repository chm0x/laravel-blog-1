<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'description',
        'status'
    ];

    # Relation between Article and the User
    # Each article belongs to One User.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    # Each article belongs to Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    # Many to Many Tags, with pivot table
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
