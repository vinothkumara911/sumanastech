<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'name' => 'Ultimate', 
                'slug' => 'Ultimate', 
                'stripe_plan' => 'price_1M8iNdSFhH8uiGdBvefN27Cv', 
                'price' => 400, 
                'description' => 'Product 4'
            ],
            [
                'name' => 'Home Package', 
                'slug' => 'Home Package', 
                'stripe_plan' => 'price_1M8iN0SFhH8uiGdB8DijDERT', 
                'price' => 300, 
                'description' => 'Product 3'
            ],
            [
                'name' => 'Professional', 
                'slug' => 'Professional', 
                'stripe_plan' => 'price_1M8iMPSFhH8uiGdBqTCCJj80', 
                'price' => 200, 
                'description' => 'Product 2'
            ],
            [
                'name' => 'Basic', 
                'slug' => 'Basic', 
                'stripe_plan' => 'price_1M8iK5SFhH8uiGdBu4n5mDYl', 
                'price' => 100, 
                'description' => 'Product 1'
            ]
        ];
        foreach ($product as $pro) {
            Product::create($pro);
        }
    }
}
