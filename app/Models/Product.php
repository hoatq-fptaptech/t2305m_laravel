<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'price',
        'thumbnail',
        'description',
        'qty',
        'category_id',
        'brand_id'
    ];

    public function getUrl(){
        return url("/detail",["product"=>$this->slug]);
    }

    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
