<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'image', 'user_id',
    ];

    /**
     * A product belongs to a user (seller).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
