<?php

namespace Database\Seeders;

use App\Models\BankType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank_types = [
            [
                'bank_name' => 'OTP',
                'icon_name' => 'otp_icon.png',
                'import_class' => 'OTPImport',

            ],
            [
                'bank_name' => 'Revolut',
                'icon_name' => 'revolut_icon.png'
            ]
        ];

        foreach($bank_types as $bank_type){
            BankType::create($bank_type);
        }
    }
}
