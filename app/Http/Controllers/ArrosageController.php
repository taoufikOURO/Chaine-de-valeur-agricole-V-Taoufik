<?php

namespace App\Http\Controllers;

use App\Models\Arrosage;
use App\Models\Semis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrosageController extends Controller
{
    public function create()
    {
        $semis = Semis::where('user_id', Auth::user()->id)
            ->where('recolte_id', null)
            ->get();
        return view('pages.arrosage.create', compact('semis'));
    }
    
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "semis_id" => 'required',
            ],
            [
                "semis_id.required" => "Ce champ est obligatoire",
            ]
        );
        $fields['user_id'] = Auth::user()->id;
        try {
            Arrosage::create($fields);
            return redirect()->route('semis.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Votre semis a été arrosée avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de l\'enrégistrement',
                'errorMessage' => 'Votre semis n\'a pas pu être arrosé. Veuillez réssayer',
            ]);
        }
    }
}
