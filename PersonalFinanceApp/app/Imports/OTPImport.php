<?php

namespace App\Imports;

use App\Models\CategoryScope;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OTPImport implements ToModel,WithHeadingRow, WithStartRow
{

    private $account;
    private $scopes;


    public function __construct($account){
        $this->account = $account;

        $this->scopes = CategoryScope::all();

    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category_id = null;

        foreach ($this->scopes as $scope){
            if(str_contains(strtolower($row['explicatie']),strtolower($scope->category_scope_name))){
                   $category_id = $scope->category_id;
            }
        }

        Transaction::firstOrCreate([
            'started_date' => date('Y-m-d',strtotime($row['data_val'])),
            'completed_date' => date('Y-m-d',strtotime($row['data_op'])),
            'description' => $row['explicatie'],
            'amount'     => $row['suma_debit'] + $row['suma_credit'],
            'user_id'       => auth()->user()->id,
            'account_id'        => $this->account,
            'category_id' => $category_id,
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }
}
