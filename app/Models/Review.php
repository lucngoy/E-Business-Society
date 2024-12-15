<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['business_id', 'user_id', 'rating', 'comment'];

    // Relation : Une review appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une review appartient à une entreprise
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
