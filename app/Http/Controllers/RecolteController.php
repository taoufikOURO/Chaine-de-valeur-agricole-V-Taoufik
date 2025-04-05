<?php

namespace App\Http\Controllers;

use App\Models\Recolte;
use App\Models\Semis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecolteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $recoltes = Recolte::where('user_id',Auth::user()->id)->orderByDesc('created_at')->get();
        return view('pages.recolte.index', compact('recoltes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semis = Semis::where('user_id', Auth::user()->id)
            ->where('recolte_id', null)
            ->get();
        return view('pages.recolte.create', compact('semis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "quantite_recolte" => 'required|numeric|min:1',
                "semis_id" => 'required|numeric',
            ],
            [
                "quantite_recolte.required" => "La quantité de recolte est obligatoire",
                "quantite_recolte.numeric" => "La quantité de recolte doit être un nombre",
                "quantite_recolte.min" => "La quantité de recolte doit être supérieure à 1",
                "semis_id.required" => "Le semis est obligatoire",
            ]
        );
        $semis = Semis::where('id', $fields['semis_id'])->first();
        $parcelle = $semis->parcelle()->first();

        $fields['user_id'] = Auth::user()->id;
        $fields['semis_id'] = $semis->id;
        $fields['parcelle_id'] = $parcelle->id;


        try {
            $recolte = Recolte::create($fields);
            $semis->update([
                "recolte_id" => $recolte->id,
            ]);
            $parcelle->update([
                "statut_id" => 2,
            ]);
            return redirect()->route('recolte.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Votre récolte a été enrégistrée avec succès.',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'Une erreur est survenue lors de l\'enrégistrement de votre récolte. Veuillez réessayer.',
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
