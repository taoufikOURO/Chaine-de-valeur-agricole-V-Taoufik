<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parcelle;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Static\StaticFunction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use PhpParser\Node\Stmt\Static_;

class AuthController extends Controller
{
    public function index()
    {
        return view("welcome");
    }
    public function loginPage()
    {
        return view("auth.login");
    }
    public function login(AuthRequest $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if ($user) {

            if ($user->active) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    return redirect(route('dashboard'));
                } else {
                    return back()->with([
                        'showErrorModal' => true,
                        'errorTitle' => 'Erreur de connexion',
                        'errorMessage' => 'Vérifiez votre adresse email et votre mot de passe puis réessayer'
                    ]);
                }
            } else {
                return back()->with([
                    'showErrorModal' => true,
                    'errorTitle' => 'Erreur de connexion',
                    'errorMessage' => 'Votre compte est désactivé, contactez l\'administrateur.'
                ]);
            }
        } else {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur de connexion',
                'errorMessage' => 'Veuillez vérifier votre adresse email ainsi que votre mot de passe puis réessayer.',
            ]);
        }
    }

    public function verifyNotice()
    {
        return view('pages.verify-email');
    }
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }
    public function verifyHandler(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice')->with('message', 'Verification link sent!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return  redirect()->route('login.page');
    }
}
