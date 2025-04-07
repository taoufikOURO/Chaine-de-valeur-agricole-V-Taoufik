<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\Semis;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $semis = Semis::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('culture_id')
            ->values();
        return view('pages.profile', compact('semis'));
    }

    public function index()
    {
        $users = User::whereNot('id', Auth::user()->id)->get();
        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.user.create', compact('roles'));
    }

    public function store(RegisterRequest $request)
    {
        $fields = $request->all();
        try {
            $user = User::create($fields);

            event(new Registered($user));

            return redirect()->route('user.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'l\'utilisateur a été créé avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'Une erreur est survenue lors de la création du compte utilisateur. Veuillez réessayer plus tard.',
            ]);
        }
    }

    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        return view('pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "active" => "required",
            "role_id" => "required",
        ]);
        $user = User::findOrFail($id);
        if ($fields['active'] == "1") {
            $fields['active'] = true;
        } else {
            $fields['active'] = false;
        }
        try {
            $user->update($fields);
            return redirect()->route('user.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Le compte utilisateur a été modifié avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la modification',
                'errorMessage' => 'L\'enregitrement des modifications apportés au compte utilisateur ont échoué. Veuillez réessayer plus tard.',
            ]);
        }
    }
}
