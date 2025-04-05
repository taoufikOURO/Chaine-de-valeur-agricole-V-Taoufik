<?php

namespace App\Http\Controllers;

use App\Models\Fertilisation;
use App\Models\Parcelle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FertilisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fertilisations = Fertilisation::where('user_id', Auth::user()->id)->get();
        return view('pages.fertilisation.index', compact('fertilisations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parcelles = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', 3)
            ->orderByDesc('created_at')
            ->get();
        return view('pages.fertilisation.create', compact('parcelles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "parcelle_id" => 'required',
                "description" => 'string|max:1000|min:20',
            ],
            [
                "parcelle_id.required" => "Le champ Parcelle est obligatoire",
                "description.max" => "Le champ Description ne doit pas dépasser 1000 caractères",
            ]
        );
        $fields['user_id'] = Auth::user()->id;
        try {
            Fertilisation::create($fields);
            return redirect()->route('fertilisation.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Votre parcelle a bien été fertilisée',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la fertilisation',
                'errorMessage' => 'Une erreur est survenue lors de la fertilisation de la parcelle. Veuillez réessayer.',
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
