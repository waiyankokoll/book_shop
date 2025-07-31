<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\soft;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'author_id',
        'price',
        'image',
        'description',
        'category_id'
    ];
    public function author() : BelongsTo
    {
        return $this->belongsTo(Author::class);
    }public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function orders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}