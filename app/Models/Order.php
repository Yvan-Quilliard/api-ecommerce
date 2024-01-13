<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'delivery_address_id',
        'order_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryAddress::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

}
