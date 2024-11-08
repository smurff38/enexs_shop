<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_user',
        'summ',
        'status',
        'payment_method',
    ];

    protected $dates = [
        'order_date',
    ];

    // Аксессор для преобразования order_date в объект Carbon
    public function getOrderDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }
}

