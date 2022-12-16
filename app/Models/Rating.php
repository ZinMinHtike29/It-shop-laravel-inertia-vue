<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'rating'];
    protected $appends = ["date"];

    public function getDateAttribute()
    {
        $d = new Carbon($this->created_at);
        return $d->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}