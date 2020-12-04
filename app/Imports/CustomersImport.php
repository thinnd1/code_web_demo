<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class CustomersImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
//    WithValidation,
//    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors, RegistersEventListeners;

    public function model(array $row)
    {
//            $user = Customer::create(
//                [
//                'username'     => $row['Tên đăng nhập'],
//                'full_name'    => $row['Họ tên'],
//                'email'        => $row['Email'],
//                'phone'        => $row['Số điện thoại'],
//                'address'      => $row['Địa chỉ'],
//                'job'          => $row['Nghề nghiệp'],
//                'company'      => $row['Công ty'],
//                'created_at'   => $row['Ngày đăng ký'],
//                ]
//            );
    }
//    public function rules(): array
//    {
//      return [
//           'Email' => ['required, unique:customers,email'],
//       ];
//    }

    public function chunkSize(): int
    {
        return 1000;
    }
//    public static function afterImport(AfterImport $event)
//    {
//    }

}
