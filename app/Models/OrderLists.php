<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLists extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'color', 'specification_id', 'qty', 'order_code', 'total_price'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}