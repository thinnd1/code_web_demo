<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToCollection;


class CustomersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = Customer::create([
                'username'     => $row[0],
                'full_name'    => $row[1],
                'email'        => $row[2],
                'phone'        => $row[3],
                'address'      => $row[4],
                'job'          => $row[5],
                'company'      => $row[6],
                'created_at'   => $row[7],
            ]);
        }
    }
    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:customers,email']
        ];
    }
}
