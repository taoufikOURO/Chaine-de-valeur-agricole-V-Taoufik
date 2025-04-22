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
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function profile()
    {
        $semis = Semis::where('user_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->get()
            ->unique('culture_id')
            ->values();
        return view('pages.profile', compact('semis'));
    }

    public function index()
    {
        $users = User::whereNot('id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);
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
        try{
            $id = Crypt::decrypt($id);
            $user = User::where('id', $id)->first();
            $roles = Role::all();
            return view('pages.user.edit', compact('user', 'roles'));
        }catch (Exception $e) {
            return redirect()->route('user.index')->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur de récupération de l\'utilisateur',
                'errorMessage' => 'Cet utilisateur n\'a pas pu être récupéré. Veuillez réessayer plus tard',
            ]);
        }
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
