<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::get();
            return view('admin.user.index', ['users' => $users]);
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        try {
            $user = User::find($id);
            return view('Ingredient.showUser', ['user' => $user]);
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function updateAvatar(Request $request, $id)
    {
        return 1;
    }

    public function destroy($id)
    {
        //
    }
}
