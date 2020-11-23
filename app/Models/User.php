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
    public function getInformation($id)
    {
        return User::where('_id', $id)->first();
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


}
