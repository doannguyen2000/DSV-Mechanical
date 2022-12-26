<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAvatarRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('apache_request_headers', ['users' => $users]);
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            return view('users.userView.show', ['user' => $user]);
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function me()
    {
        try {
            $user = User::find(Auth::user()->id);
            return view('users.userView.show', ['user' => $user]);
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $params = $request->validated();
            $user = User::find($id);
            if (!$user) return 'error';
            $user->update($params);
            return (Auth::user()->role == 'root_admin') ?  redirect()->route('user.show', ['id' => $id]) : redirect()->route('user.me');
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function updateAvatar(UpdateAvatarRequest $request, $id)
    {
        try {
            $params = $request->validated();
            $user = User::find($id);
            if (!$user) return 'error';
            $avatar = FileHelper::uploadFile($params['avatar'], 'user/avatar');
            if ($avatar) {
                $avatarData = [
                    'name' => $avatar['fileName'],
                    'file' => $avatar['fileName'],
                ];
                if ($user->avatar) {
                    FileHelper::deleteFile($user->avatar()->value('name'), 'user/avatar');
                    $user->avatar()->update($avatarData);
                } else {
                    $user->avatar()->create($avatarData);
                }
            }
            return (Auth::user()->role == 'root_admin') ?  redirect()->route('user.show', ['id' => $id]) : redirect()->route('user.me');
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function action()
    {
        //
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return 'error';
        $user->delete();
        return  redirect()->back()->withInput();;
    }
}
