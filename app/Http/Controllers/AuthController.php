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
    }

    public function verifyNotice()
    {
        return view('pages.verify-email');
    }
    public function verifyEmail (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard');
    }
    public function verifyHandler (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return  redirect()->route('login.page');
    }
    public function dashboard()
    {
        
        $parcelles=$this->getGlobalData();
        return view('pages.dashboard',['parcelles'=>$parcelles]);
    }
    public function stream()
    {
        $data=$this->getGlobalData();
        return StaticFunction::stream('globalStats',['data'=>$data],'statistique');
    }
    
    public function getGlobalData()
    {
        $parcelles = Parcelle::with([
            'semis.culture',
            'fertilisation',
            'recolte'
        ])->get();
    
    
        $data = $parcelles->map(function ($parcelle) {
            return [
              
                "nom" => $parcelle->nom,
                "recoltes" => $parcelle->recolte->map(function ($recolte) {
                    return [
                        "qte" => $recolte->quantite_recolte,
                        "date_recolte" => Carbon::parse($recolte->date_recolte)->translatedFormat('d M Y'),
                        "semis" => [
                            "date_semis" => Carbon::parse($recolte->semis->date_semis)->translatedFormat('d M Y'),
                            "culture" => [
                                "nom_culture" =>  $recolte->semis->culture->nom, 
                            ]
    
                        ]
    
                    ];
                }),
            ];
        });
        return $data;
    }
    
}
