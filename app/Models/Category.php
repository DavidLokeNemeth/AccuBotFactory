<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
    ];

    //Validation rules
    public static $rules = [
        'category' => 'required|string',
    ];

    //Validation before save
    public static function boot()
    {
        parent::boot();

        static::creating(function (Category $category) {
            Validator::validate($category->toArray(), static::$rules);
        });

        static::saving(function (Category $category) {
            Validator::validate($category->toArray(), static::$rules);
        });
    }

}
