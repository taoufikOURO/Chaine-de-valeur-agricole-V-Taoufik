<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Parcelle;
use App\Models\Semis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SemisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semis = Semis::where("user_id", Auth::user()->id)
            ->where('recolte_id', null)
            ->get();
        return view('pages.semis.index', compact('semis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cultures = Culture::all();
        $parcelles = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', [2,3])
            ->get();
        return view('pages.semis.create', compact('cultures', 'parcelles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "culture_id" => 'required',
                "parcelle_id" => 'required',
            ],
            [
                "culture_id.required" => "Le champ culture_id est obligatoire.",
                "parcelle_id.required" => "Le champ parcelle_id est obligatoire.",
            ]
        );
        $fields['user_id'] = Auth::user()->id;
        try {
            Semis::create($fields);
            $parcelle = Parcelle::find($fields['parcelle_id']);
            $parcelle->update([
                "statut_id" => 1,
            ]);
            return redirect()->route('semis.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Votre semis a été ajoutée avec succès.',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'Une erreur est survenue lors de l\'ajout de votre semis. Veuillez réessayer.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
