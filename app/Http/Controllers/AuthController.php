<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if(Auth::user()->name){
            return redirect()->route("article.index")->with("info", "Vous etes dejà connecter !");
        }
        return view('auth.login');
    }

    public function seLoger(Request $request){
        $validate = Validator::make(
            [
                'email' => $request->input("email"),
                'password' => $request->input("password"),
            ],
            [
                "email" => ["required", "email"],
                "password" => ["required", "min:6"],
            ]
        );

        $credentials = $validate->validated();

        // Loger un utilisateur depuis le formulaire de connection
        // Auth::attempt($credentials);

        // Loger unutilisateur récupérer en bd
        // Auth::login(User::find(1));

        // Loger une utilisateur par id
        // Auth::loginUsingId(1);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended(route("article.index"));
        } else {
            return redirect()->route("auth.login")->withErrors([
                "err" => "Informations de connection invalide"
            ]);
        }


    }

    public function deconnection(){
        Auth::logout();
        return redirect()->route("auth.login");
    }
}
