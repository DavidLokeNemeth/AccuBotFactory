<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'description',
        'category_id',
        'weight',
    ];

    //Validation rules
    public static $rules = [
        'sku' => 'required|string',
        'description' => 'required|string',
        'weight' => 'required|regex:/^\d*(\.\d{1,2})?$/',
    ];

    //Validation before save
    public static function boot()
    {
        parent::boot();

        static::creating(function (Component $component) {
            Validator::validate($component->toArray(), static::$rules);
        });

        static::saving(function (Component $component) {
            Validator::validate($component->toArray(), static::$rules);
        });
    }

    // Define the relationship with the category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
