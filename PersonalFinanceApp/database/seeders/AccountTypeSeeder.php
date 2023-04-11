<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountTypes = [
            [
              'id' => 1,
              'account_type' => 'Cash',
                'icon_name' => 'cash_icon.png',
            ],
            [
                'id' => 2,
                'account_type' => 'Credit card',
                'icon_name' => 'credit_card_icon.png'
            ]
        ];


        foreach($accountTypes as $accountType){
            AccountType::create($accountType);
        }
    }
}
