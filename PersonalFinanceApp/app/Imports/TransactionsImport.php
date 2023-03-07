<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TransactionsImport implements ToModel,WithHeadingRow, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            'started_date' => date('Y-m-d',strtotime($row['data_val'])),
            'completed_date' => date('Y-m-d',strtotime($row['data_op'])),
            'description' => $row['explicatie'],
            'amount'     => $row['suma_debit'] + $row['suma_credit'],
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }
}
