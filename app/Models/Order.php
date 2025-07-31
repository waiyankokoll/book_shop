<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'phone_number',
        'shipping_address',
        'payment_type',
        'total_amount',
    ];
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function books() : BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
