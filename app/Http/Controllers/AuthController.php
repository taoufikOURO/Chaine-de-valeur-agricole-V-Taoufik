<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view("auth.login");
    }
    public function login(AuthRequest $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect(route('dashboard'));
        } else {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur de connexion',
                'errorMessage' => 'Vérifiez votre adresse email et votre mot de passe puis réessayer'
            ]);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return  redirect()->route('login.page');

    }
    public function dashboard(){
        return view('pages.dashboard');
    }
}
