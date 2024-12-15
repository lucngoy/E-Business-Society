<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'category_id',
        'address',
        'phone',
        'website',
        'description',
        'opening_hours',
        'image',
        'user_id',
    ];

    
    // Relation : Un business a plusieurs reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Calculer la note moyenne des avis
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
