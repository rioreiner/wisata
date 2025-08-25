<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'location', 
        'price', 'image', 'gallery', 'status', 'rating'
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    public function updateRating()
    {
        $avgRating = $this->approvedReviews()->avg('rating');
        $this->update(['rating' => $avgRating ?? 0]);
    }
}