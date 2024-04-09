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
        "paid"
    ];

    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_SHIPPING = 2;
    const STATUS_SHIPPED = 3;
    const STATUS_COMPLETE = 4;
    const STATUS_CANCEL = 5;


    public function statusLabel(){
        switch ($this->status){
            case self::STATUS_PENDING: return '<span class="text-gray-dark">Chờ xác nhận</span>';
            case self::STATUS_CONFIRMED: return '<span class="text-warning">Đã xác nhận</span>';
            case self::STATUS_SHIPPING: return '<span class="text-info">Đang vận chuyển</span>';
            case self::STATUS_SHIPPED: return '<span class="text-success">Đã giao hàng</span>';
            case self::STATUS_COMPLETE: return '<span class="text-success">Hoàn thành</span>';
            case self::STATUS_CANCEL: return '<span class="text-danger">Huỷ</span>';
        }
    }

    public function Products(){
        return $this->belongsToMany(Product::class,"order_products")->withPivot(["qty","price"]);
    }
}
