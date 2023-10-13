<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
    ];

    //Validation rules
    public static $rules = [
        'id' => 'required|integer',
        'customer_name' => 'required|string',
        'robot_name' => 'nullable|string',
    ];

    //Validation before save
    public static function boot()
    {
        parent::boot();

        static::creating(function (Order $order) {
            Validator::validate($order->toArray(), static::$rules);
        });

        static::saving(function (Order $order) {
            Validator::validate($order->toArray(), static::$rules);
        });
    }

    // Define the relationship with the Component model
    public function items()
    {
        return $this->belongsToMany(Component::class, 'order_lists')->withPivot('quantity');
    }

    // Calculate the total weight of this order
    public function calculateTotalWeight()
    {
        return $this->items->sum(function ($component) {
            return $component->weight * $component->pivot->quantity;
        });
    }
}
