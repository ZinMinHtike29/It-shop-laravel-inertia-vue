<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_code', 'order_status', 'total_price', 'created_at'];
    protected $appends = ["date"];

    public function getDateAttribute()
    {
        $c = new Carbon($this->created_at);
        return $c->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
