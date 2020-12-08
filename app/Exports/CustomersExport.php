<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class CustomersExport implements FromView
{
    use Exportable;

    private $customers;

    public function __construct(Collection $customers)
    {
        $this->customers = $customers;
    }

    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    public function view(): View
    {
        return view('admin.export', [
//            'customers' => Customer::select('username', 'full_name','email','phone', 'address','job','company','created_at')->get()
            'customers' => $this->customers
        ]);
    }

}
