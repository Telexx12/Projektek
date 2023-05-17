<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Investment',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Obligations',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Insurance',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Rent',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Tax',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Housekeeping',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Food',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Health',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Car',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Pets',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Personal',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Education',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Entertainment',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Hobby',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Travelling',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Payment',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Scholarship',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Secondary income',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Pension',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Aid',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
            [
                'category_name' => 'Interest',
                'category_color' => '#e5e5e5',
                'user_id' => null,
            ],
        ];

        foreach($categories as $category){
            Categories::create($category);
        }
    }
}
