<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Import extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'imports';

    protected $fillable = [
        'full_name', 'username', 'email', 'password', 'age', 'gender', 'phone', 'address', 'job', 'role', 'company', 'id_custumor'
    ];

    public  function getAll($id_file)
    {
        return Import::where('id_file', $id_file)->paginate(10);
    }
    public function getCount()
    {
        return Import::where('id_file', Auth::user()->id)->get();
    }
    public function deleteRecord($id)
    {
        $delete = Import::findOrFail($id);
        return $delete->delete();
    }


}
