<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Models\Semis;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $semis = Semis::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('culture_id')
            ->values();
        return view('pages.profile', compact('semis'));
    }

    public function edit(string $id)
    {
        $user = Auth::user();
        return view('pages.edit-profile', compact('user'));
    }

    public function update(EditProfileRequest $request, string $id)
    {
        $fields = $request->all();
        try {
            User::findOrFail(Auth::user()->id)->update($fields);
            return redirect()->route('profile.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Les informations de votre profile ont bien été modifiés',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la modification',
                'errorMessage' => 'Une erreur est survenue lors de la modification des informations de votre profile. Le nom d\'utilissateur que vous avez saisi existe probablement déjà',
            ]);
        }
    }
}
