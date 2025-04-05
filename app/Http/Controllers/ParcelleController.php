<?php

namespace App\Http\Controllers;

use App\Models\Parcelle;
use App\Models\Statut;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ParcelleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        #recupérer selon un id
        $parcelles = Parcelle::where('user_id', Auth::user()->id)->get();
        return view('pages.parcelle.index', compact('parcelles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuts = Statut::all();
        return view('pages.parcelle.create', compact('statuts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "nom" => 'required|string|max:255|min:3',
                "surface" => 'required|numeric',
                "adresse" => 'required|string|max:255|min:3',
                "statut_id" => 'required',
            ],
            [
                "nom.required" => "Le libelle est obligatoire",
                "nom.max" => "Le libelle ne doit pas dépasser 255 caractères",
                "nom.min" => "Le libelle doit contenir au moins 3 caractères",

                "surface.required" => "La surface est obligatoire",
                "surface.numeric" => "La surface doit être un nombre",
                "adresse.required" => "L'adresse est obligatoire",

                "adresse.max" => "L'adresse ne doit pas dépasser 255 caractères",
                "adresse.min" => "L'adresse doit contenir au moins 3 caractères",

                "statut_id.required" => "Le statut est obligatoire",
            ]
        );
        $fields['code'] = Str::uuid()->toString();
        $fields['user_id'] = Auth::user()->id;
        try {
            Parcelle::create($fields);
            return redirect()->route('parcelle.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'La parcelle a été créée avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'La parcelle n\'a pas pu être créé. Elle existe probablement déjà',
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
        $parcelle = Parcelle::findOrFail($id);
        return view(
            'pages.parcelle.edit',
            compact('parcelle')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "nom" => 'required|string|max:255|min:3',
            "surface" => 'required|numeric',
            "adresse" => 'required|string|max:255|min:3',
        ], [
            "nom.required" => "Le libelle est obligatoire",
            "nom.max" => "Le libelle ne doit pas dépasser 255 caractères",
            "nom.min" => "Le libelle doit contenir au moins 3 caractères",
            "surface.required" => "La surface est obligatoire",
            "adresse.required" => "L'adresse est obligatoire",
            "adresse.max" => "L'adresse ne doit pas dépasser 255 caractères",
            "adresse.min" => "L'adresse doit contenir au moins 3",
        ]);
        try {
            Parcelle::findOrFail($id)->update($fields);
            return redirect()->route('parcelle.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'La parcelle a été modifiée avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la modification',
                'errorMessage' => 'Cette parcelle n\'a pas pu être modifiée, car une autre parcelle porte déjà ce nom.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        if ($parcelle->semis()->exists() || $parcelle->fertilisation()->exists() || $parcelle->recolte()->exists()) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la suppression',
                'errorMessage' => 'Cet élément ne peux pas être supprimé car il est lié à un autre élément',
            ]);
        } else {
            $parcelle->delete();
            return back()->with([
                'showSuccessModal' => true,
                'successTitle' => 'Suppression réussie',
                'successMessage' => 'La parcelle a bien été supprimé',
            ]);
        }
    }
}
