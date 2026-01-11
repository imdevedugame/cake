<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'image',
        'is_featured',
        'category_id',
        'discount_id',
    ];

    protected $appends = [
        'final_price',
        'discount_percent_label',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (FINAL PRICE & BADGE)
    |--------------------------------------------------------------------------
    */

    public function getFinalPriceAttribute()
    {
        if (
            $this->discount &&
            now()->between($this->discount->start_date, $this->discount->end_date)
        ) {
            return round(
                $this->price * (100 - $this->discount->percent) / 100
            );
        }
    
        return $this->price;
    }
    
    public function getDiscountPercentLabelAttribute()
    {
        if (
            $this->discount &&
            now()->between($this->discount->start_date, $this->discount->end_date)
        ) {
            return $this->discount->percent;
        }
    
        return null;
    }
/*        |--------------------------------------------------------------------------
    | AUTO SLUG
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
