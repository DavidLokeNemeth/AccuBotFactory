<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class OrderList extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'component_id',
        'quantity',
    ];

    /**
     * Validation rules
     *
     * @var string[]
     */
    public static $rules = [
        'quantity' => 'required|integer',
    ];

    /**
     * Validation before save setup
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (OrderList $orderList) {
            Validator::validate($orderList->toArray(), static::$rules);
        });

        static::saving(function (OrderList $orderList) {
            Validator::validate($orderList->toArray(), static::$rules);
        });
    }
}
