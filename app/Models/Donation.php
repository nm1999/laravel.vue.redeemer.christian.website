<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'amount',
        'currency',
        'stripe_payment_intent_id',
        'status',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }
}
