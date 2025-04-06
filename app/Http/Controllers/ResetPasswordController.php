<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function passwordRequest()
    {
        return view('pages.forgot-password');
    }
    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Un méssage de confirmation a été envoyé à votre adresse email',
            ])
            : back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Une erreur est survenue',
                'errorMessage' => 'L\'envoi du message de confirmation sur votre adresse email a échoué. Veuillez réessayer plus tard',
            ]);
    }
    public function passwordReset(string $token)
    {
        return view('pages.reset-password', ['token' => $token]);
    }
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login.page')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Votre mot de passe a été modifié avec succès',
            ])
            : back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Une erreur est survenue',
                'errorMessage' => 'La modification du mot de passe a échoué. Veuillez réessayer plus tard.',
            ]);
    }
}
