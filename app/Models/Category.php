<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Spécifiez explicitement la table

    protected $fillable = ['id', 'category_name'];

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

}