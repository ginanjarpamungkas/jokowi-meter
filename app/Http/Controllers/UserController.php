<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getData(){
        $user = User::get();
        return view('auth.list',compact('user'));
    }

    public function store(Request $request){
        //dd($request->all());
        $validator = $this->validate($request, [
            'name' => 'required|unique:users',
            'divisi' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'name.unique' => 'Nama sudah digunakan. Coba yang lain.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.  Coba yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Kedua kolom password harus sama.'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->divisi = $request->divisi;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'User baru sudah ditambahkan.');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'successs' => 'Record Delete successsfully'
        ]);
    }
}
