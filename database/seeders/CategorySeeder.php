<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Définition des catégories principales et sous-catégories
        $categories = [
            [
                'category_name' => 'Restaurants',
            ],
            [
                'category_name' => 'Cafes',
            ],
            [
                'category_name' => 'Professional Services',
            ],
            [
                'category_name' => 'Amenities',
            ],
            [
                'category_name' => 'Health & Wellness',
            ],
            [
                'category_name' => 'Shopping',
            ],
            [
                'category_name' => 'Education',
            ],
            [
                'category_name' => 'Transport & Travel',
            ],
            [
                'category_name' => 'Arts & Leisure',
            ],
            [
                'category_name' => 'Technology',
            ],
            [
                'category_name' => 'Construction & Habitat',
            ],
            [
                'category_name' => 'Events & Activities',
            ],
            [
                'category_name' => 'Local Products',
            ],
            [
                'category_name' => 'Home Services',
            ],
            [
                'category_name' => 'Others',
            ],
        ];

        // Insertion des catégories et sous-catégories
        foreach ($categories as $categoryData) {
            $category = Category::create([
                'category_name' => $categoryData['category_name'],
            ]);
        }
    }
}
