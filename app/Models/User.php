<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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
        $addUser->role = 2;

        $addUser->save();
    }
    public function getInformation($id)
    {
        return User::where('_id', $id)->first();
    }
    public function updateInformation($request, $id)
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
        $updateUser->role = $request['role'];
        $updateUser->address = $request['address'];
        $updateUser->job = $request['job'];
        $updateUser->company = $request['company'];

        $updateUser->save();
    }

    public function importCsv($request)
    {

    }
    public function getUser($search = null)
    {
        $listUser =  User::where('_id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        if ($search) {
            $listUser = User::where('_id', '!=', Auth::user()->id)
                ->where('full_name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->paginate(10);
            $listUser->appends(request()->input())->links();
        }
        return $listUser;
    }
    public function userDetail($id)
    {
        return User::where('_id', $id)->first();
    }
    public function removeUser($id)
    {
        $removeUser = User::findOrFail($id);
        $removeUser->delete();
    }
    public function getAll()
    {
        return User::all();
    }

}
