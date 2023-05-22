<?php

namespace Database\Seeders;

use App\Models\CategoryScope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scopes = [
            [
              'category_scope_name' => 'OMV',
              'category_id' =>  '9'
            ],
            [
                'category_scope_name' => 'Hamm',
                'category_id' =>  '7'
            ],
            [
                'category_scope_name' => 'Chickens Food',
                'category_id' =>  '7'
            ],
            [
                'category_scope_name' => 'KFC',
                'category_id' =>  '7'
            ],
            [
                'category_scope_name' => 'PCWORLD',
                'category_id' =>  '14'
            ],
            [
                'category_scope_name' => 'GLOVO',
                'category_id' =>  '7'
            ],
            [
                'category_scope_name' => 'SteamGames.com',
                'category_id' =>  '13'
            ],
            [
                'category_scope_name' => 'Harmopan',
                'category_id' =>  '7'
            ],
            [
                'category_scope_name' => 'Google Payment',
                'category_id' =>  '13'
            ],
            [
                'category_scope_name' => 'Shein',
                'category_id' =>  '11'
            ],
            [
                'category_scope_name' => 'Universitatea',
                'category_id' =>  '12'
            ],
            [
                'category_scope_name' => 'AREOPOLIS SRL',
                'category_id' => '18'
            ],
            [
                'category_scope_name' => 'KOVACS ZOLTAN',
                'category_id' => '16'
            ]
        ];

        foreach($scopes as $scope){
            CategoryScope::create($scope);
        }
    }
}
