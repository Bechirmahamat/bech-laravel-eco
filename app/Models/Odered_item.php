<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odered_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'order_id',
        'user_id',
        'price',
        'quantity',
        'image',
        'order_status'
    ];
}
