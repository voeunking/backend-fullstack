<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Computer', 'description' => 'Laptops, desktops, and accessories'],
            ['name' => 'Phones', 'description' => 'Smartphones and mobile accessories'],
            ['name' => 'Audio', 'description' => 'Headphones, speakers, and audio gear'],
            ['name' => 'Wearables', 'description' => 'Smartwatches and fitness trackers'],
            ['name' => 'Accessories', 'description' => 'Cables, cases, and more'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}