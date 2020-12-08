<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
//    public function collection()
//    {
//        //
//        return Order::select( 'id_user', 'id_product', 'total_price', 'address', 'orderdate', 'phone', 'email', 'status','payment')
//            ->get();
//    }
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    public function view(): View
    {
        return view('admin.exportorder', [
            'orders' => Order::select( 'id_user', 'id_product', 'total_price', 'address', 'orderdate', 'phone', 'email', 'status','payment')
            ->get()
        ]);
    }
}
