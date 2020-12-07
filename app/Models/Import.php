<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Import extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'imports';

    protected $fillable = [
        'full_name', 'username', 'email', 'password', 'age', 'gender', 'phone', 'address', 'job', 'role', 'company', 'id_custumor'
    ];

    public  function getAll()
    {
        return Import::paginate(10);
    }
    public function getCount()
    {
        return Import::all();
    }
    public function deleteRecord($id)
    {
        $delete = Import::findOrFail($id);
        return $delete->delete();
    }


}
