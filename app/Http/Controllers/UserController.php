<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUser(){
        
        $user = User::all();

        return view('user/lista', [
            'users' => $user
        ]);
    }

    public function create(){
        return view('user/create');
    }

    public function createUser(Request $request){

    //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'rol'      => 'required',
            'password'  => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back();
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->rol = $request->input('rol');
        $user->save();

        return redirect()->route('user.lista');
    }

    public function update($id){
        $user = User::where('id', $id)->first();

        return view('user/create', [
            'user' => $user
        ]);

    }

    public function updateUser(Request $request, $user_id){

        $user = User::where('id', $user_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required',
            'rol'      => 'required',
            'password'  => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->rol = $request->input('rol');
        $user->save();

        return redirect()->route('user.lista');
    }
    

    public function deleteUser(){
        
    }
}
