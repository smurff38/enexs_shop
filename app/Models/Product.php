<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';
    protected $table = 'products';

    // Указываем, какие поля можно заполнять
    protected $fillable = [
        'name_product',
        'description',
        'picture',
        'price',
        'kol',
        'id_category',
    ];

    // Указываем типы для полей, если они требуют преобразования
    protected $casts = [
        'price' => 'decimal:2',
        'kol' => 'integer',
    ];

    /**
     * Связь с категорией продукта.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    /**
     * Связь с `OrderItem`, чтобы получить заказы, связанные с продуктом.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_product', 'id_product');
    }
}

