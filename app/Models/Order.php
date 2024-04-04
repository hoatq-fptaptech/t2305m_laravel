<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'grand_total',
        'shipping_address',
        'shipping_method',
        'payment_method',
        'status',
        'first_name',
        'last_name',
        'city',
        'telephone',
        'email',
        'order_note',
    ];

    public function Products(){
        return $this->belongsToMany(Product::class,"order_products")->withPivot(["qty","price"]);
    }
}
