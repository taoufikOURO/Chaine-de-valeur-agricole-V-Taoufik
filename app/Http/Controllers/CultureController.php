<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\TypeCulture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CultureController extends Controller
{
    public function index()
    {
        $cultures = Culture::all();
        return view(
            'pages.culture.index',
            compact('cultures')
        );
    }

    public function create()
    {
        $typeCultures = TypeCulture::all();
        return view(
            'pages.culture.create',
            compact('typeCultures')
        );
    }

    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "type_culture_id" => 'required',
                "nom" => 'required|string|max:255|min:3',
            ],
            [
                "nom.required" => "Le libelle est obligatoire",
                "nom.max" => "Le libelle ne doit pas dépasser 255 caractères",
                "nom.min" => "Le libelle doit contenir au moins 3 caractères"
            ]
        );
        $fields['code'] = Str::uuid()->toString();
        try {
            Culture::create($fields);
            return redirect()->route('culture.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'La culture a été créée avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'La culture n\'a pas pu être créé. Elle existe probablement déjà',
            ]);
        }
    }

    public function edit(string $id)
    {
        $culture = Culture::findOrFail($id);
        $typeCultures = TypeCulture::all();
        return view('pages.culture.edit', compact('culture', 'typeCultures'));
    }

    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "type_culture_id" => 'required',
            "nom" => 'required|string|max:255|min:3',
        ], [
            "nom.required" => "Le libelle est obligatoire",
            "nom.max" => "Le libelle ne doit pas dépasser 255 caractères",
            "nom.min" => "Le libelle doit contenir au moins 3 caractères"
        ]);
        try {
            Culture::findOrFail($id)->update($fields);
            return redirect()->route('culture.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'La culture a été modifiée avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la modification',
                'errorMessage' => 'Cette culture n\'a pas pu être modifié, car une autre culture porte déjà ce nom.',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $culture = Culture::findOrFail($id);
        if ($culture->semis()->exists()) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la suppression',
                'errorMessage' => 'Cet élément ne peux pas être supprimé car il est lié à un autre élément',
            ]);
        } else {
            $culture->delete();
            return back()->with([
                'showSuccessModal' => true,
                'successTitle' => 'Suppression réussie',
                'successMessage' => 'La culture a bien été supprimé',
            ]);
        }
    }
}
