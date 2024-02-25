<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Oders extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'user_id',
        'price',
        'email',
        'name',
        'address',
        'phone',
        'city',
        'order_status'
    ];
}
