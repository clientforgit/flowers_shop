<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['name',
                        'surname',
                        'email',
                        'phone',
                        'region',
                        'city',
                        'address',
                        'payment_method',
                        'card_num',
                        'expiration_date',
                        'CVV'];
    protected $attributes = ['name' => null,
        'surname' => null,
        'email' => null,
        'phone' => null,
        'region' => null,
        'city' => null,
        'address' => null,
        'payment_method' => null,
        'card_num' => null,
        'expiration_date' => null,
        'CVV' => null];
}
