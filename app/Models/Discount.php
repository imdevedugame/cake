<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Carbon\Carbon;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'percent',
        'banner_image',
        'start_date',
        'end_date',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // 1 Discount → banyak Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS (LOGIC DISKON)
    |--------------------------------------------------------------------------
    */

    // 🔹 status published
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    // 🔹 coming soon (published tapi belum mulai)
    public function isComingSoon(): bool
    {
        if (!$this->isPublished() || !$this->start_date) {
            return false;
        }

        return Carbon::now()->lt(Carbon::parse($this->start_date));
    }

    // 🔹 aktif (published + dalam rentang tanggal)
    public function isActive(): bool
    {
        if (!$this->isPublished()) {
            return false;
        }

        if ($this->start_date && $this->end_date) {
            return Carbon::now()->between(
                Carbon::parse($this->start_date),
                Carbon::parse($this->end_date)
            );
        }

        return false;
    }

    // 🔹 expired (tanggal sudah lewat)
    public function isExpired(): bool
    {
        if (!$this->end_date) {
            return false;
        }

        return Carbon::now()->gt(Carbon::parse($this->end_date));
    }
}
