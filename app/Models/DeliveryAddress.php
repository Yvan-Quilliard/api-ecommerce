<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAddress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'recipient_name',
        'recipient_phone',
        'address',
        'postal_code',
        'city',
        'country',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
