<?php

namespace Database\Seeders;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            'Computer' => [
                ['name' => 'MacBook Pro 16"', 'price' => 2499, 'description' => 'Apple M3 Pro chip with 18GB RAM and 512GB SSD', 'ram' => '18GB', 'cpu' => 'M3 Pro', 'storage' => '512GB SSD', 'stock' => 10, 'discount_percent' => 0],
                ['name' => 'Dell XPS 15', 'price' => 1799, 'description' => '15.6" 4K display, Intel i7, 32GB RAM, 1TB SSD', 'ram' => '32GB', 'cpu' => 'Intel i7', 'storage' => '1TB SSD', 'stock' => 5, 'discount_percent' => 5],
                ['name' => 'Gaming Desktop', 'price' => 1899, 'description' => 'RTX 4080, AMD Ryzen 9, 64GB RAM, 2TB NVMe', 'ram' => '64GB', 'cpu' => 'Ryzen 9', 'storage' => '2TB NVMe', 'stock' => 3, 'discount_percent' => 10],
                ['name' => 'Wireless Mouse', 'price' => 79, 'description' => 'Ergonomic design with 2-year battery life', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 50, 'discount_percent' => 0],
            ],
            'Phones' => [
                ['name' => 'iPhone 15 Pro', 'price' => 999, 'description' => '6.1" display, A17 Pro chip, 128GB storage', 'ram' => '8GB', 'cpu' => 'A17 Pro', 'storage' => '128GB', 'stock' => 25, 'discount_percent' => 0],
                ['name' => 'Samsung Galaxy S24', 'price' => 899, 'description' => '6.2" Dynamic AMOLED, Snapdragon 8 Gen 3, 256GB', 'ram' => '8GB', 'cpu' => 'Snapdragon 8 Gen 3', 'storage' => '256GB', 'stock' => 2, 'discount_percent' => 0],
                ['name' => 'Google Pixel 8', 'price' => 699, 'description' => '6.2" OLED, Tensor G3, 128GB storage', 'ram' => '8GB', 'cpu' => 'Tensor G3', 'storage' => '128GB', 'stock' => 15, 'discount_percent' => 8],
                ['name' => 'Phone Case Pro', 'price' => 29, 'description' => 'Military-grade protection with wireless charging', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 100, 'discount_percent' => 0],
            ],
            'Audio' => [
                ['name' => 'AirPods Pro', 'price' => 249, 'description' => 'Active noise cancellation, spatial audio', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 30, 'discount_percent' => 0],
                ['name' => 'Sony WH-1000XM5', 'price' => 399, 'description' => 'Industry-leading noise canceling headphones', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 1, 'discount_percent' => 0],
                ['name' => 'JBL Flip 6', 'price' => 129, 'description' => 'Waterproof portable Bluetooth speaker', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 8, 'discount_percent' => 0],
            ],
            'Wearables' => [
                ['name' => 'Apple Watch Series 9', 'price' => 429, 'description' => 'GPS, heart rate monitor, fitness tracking', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 12, 'discount_percent' => 0],
                ['name' => 'Samsung Galaxy Watch6', 'price' => 299, 'description' => 'AMOLED display, health monitoring', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 7, 'discount_percent' => 0],
            ],
            'Accessories' => [
                ['name' => 'USB-C Hub', 'price' => 49, 'description' => '7-in-1 multi-port adapter for laptops', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 40, 'discount_percent' => 0],
                ['name' => 'Laptop Stand', 'price' => 39, 'description' => 'Adjustable aluminum stand for MacBook', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 4, 'discount_percent' => 0],
                ['name' => 'Cable Pack', 'price' => 25, 'description' => 'USB-C, Lightning, and HDMI cables (3-pack)', 'ram' => null, 'cpu' => null, 'storage' => null, 'stock' => 50, 'discount_percent' => 0],
            ],
        ];

        foreach ($products as $categoryName => $categoryProducts) {
            $category = Category::where('name', $categoryName)->first();
            if ($category) {
                foreach ($categoryProducts as $product) {
                    Product::create([
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'description' => $product['description'],
                        'category_id' => $category->id,
                        'image' => null,
                        'stock' => $product['stock'],
                        'discount_percent' => $product['discount_percent'],
                        'ram' => $product['ram'] ?? null,
                        'cpu' => $product['cpu'] ?? null,
                        'storage' => $product['storage'] ?? null,
                    ]);
                }
            }
        }
    }
}