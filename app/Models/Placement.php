<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'customer_name',
        'customer_email',
        'customer_address',
        'total_price',
        'status',
    ];
}
