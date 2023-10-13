<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
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

    //Generate a musing robot name
    public function generateRobotName()
    {
        $prefixArray = ['Hydra', 'Sterling', 'Self Emulator', 'Opium', 'Exon', 'Pixels', 'Dragon', 'Arm', 'Intel', 'Zeek', 'Titan', 'Alexa', 'Duster', 'Sully', 'Alicia'];
        $prefix = $prefixArray[array_rand($prefixArray)];

        $categoryId = $this->calculateMostPrevalentCategory();

        switch ($categoryId) {
            case 1:
                $mainArray = ['Micro', 'Machina', 'RAM', 'Automata'];
                break;
            case 2:
                $mainArray = ['Trek', 'Olympus', 'Technician', 'Screwie'];
                break;
            case 3:
                $mainArray = ['DeathStar', 'Link', 'Gollum', 'Prima'];
                break;
            case 4:
                $mainArray = ['Curiosity', 'Tallie', 'Amerigo', 'Scrap'];
                break;
            case 5:
                $mainArray = ['Sparkles', 'Radion', 'Bruno', 'Sputnik'];
                break;
            case 6:
                $mainArray = ['Ash', 'Ruin', 'Omon', 'Percy'];
                break;
            case 7:
                $mainArray = ['Reflector', 'Cowbot', 'Brainy', 'Elixir'];
                break;
            case 8:
                $mainArray = ['Boron', 'Antenna', 'Mari', 'Chip'];
                break;
            default:
                $mainArray = ['Hector', 'UNO', 'Achilles', 'Logan'];
                break;
        }

        $main = $mainArray[array_rand($mainArray)];

        $tagArray = ['bot', 'nom', 'er'];

        $tag = $tagArray[array_rand($tagArray)];

        $robotName = ucfirst($prefix) . ' ' . ucfirst($main) . strtolower($tag);

        return $robotName;
    }

    // Calculate the most prevalent category
    public function calculateMostPrevalentCategory()
    {
        $mostUsedCategory = DB::table('order_lists')
            ->where('order_id', '=', $this->id)
            ->select('category_id', DB::raw('COUNT(*) as item_count'))
            ->leftJoin('components', 'component_id', '=', 'components.id')
            ->groupby('category_id')
            ->orderby('item_count', 'desc')
            ->first();

        return $mostUsedCategory->category_id;
    }
}
