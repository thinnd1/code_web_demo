<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Eloquent implements Authenticatable
{
    use Notifiable;
    use AuthenticatableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'username', 'email', 'password', 'age', 'gender', 'phone', 'address', 'job', 'role', 'company'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function signup($request)
    {
        $addUser = new User();

        $addUser->username = $request['username'];
        $addUser->password = Hash::make($request['password']);
        $addUser->full_name = $request['full_name'];
        $addUser->email = $request['email'];
        $addUser->role = 1;

        $addUser->save();
    }
    public function getInformation()
    {
        return User::where('_id', '5fb4e7d5986a000045007362')->first();
    }
    public function updateInformation($id, $request)
    {
//        $data = [
//
//        ];
        $updateUser = User::findOrFail($id);

        $updateUser->username = $request['username'];
        $updateUser->full_name = $request['full_name'];
        $updateUser->gender = $request['gender'];
        $updateUser->email = $request['email'];
        $updateUser->age = $request['age'];
        $updateUser->phone = $request['phone'];
        $updateUser->address = $request['address'];
        $updateUser->job = $request['job'];
        $updateUser->company = $request['company'];

        $updateUser->save();
    }
    public function listCustomer()
    {
        return User::all();
    }
    public function deleteUser($id)
    {
        $deleteUser = User::find($id);
        return $deleteUser->delete();
    }

}
