<?php

namespace App\Http\Controllers;

use App\Models\TypeCulture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeCultureController extends Controller
{
    public function index()
    {
        $typeCultures = TypeCulture::all();
        return view(
            'pages.type-culture.index',
            compact('typeCultures')
        );
    }

    public function create()
    {
        return view('pages.type-culture.create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "libelle" => 'required|string|max:255|min:3',
            ],
            [
                "libelle.required" => "Le libelle est obligatoire",
                "libelle.max" => "Le libelle ne doit pas dépasser 255 caractères",
                "libelle.min" => "Le libelle doit contenir au moins 3 caractères"
            ]
        );
        $code = Str::uuid()->toString();
        $fields['code'] = Str::uuid()->toString();
        try {
            TypeCulture::create($fields);
            return redirect()->route('type-culture.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Type de culture créée avec succès',
            ]);
        } catch (Exception $e) {

            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'Ce type de culture n\'a pas pu être créé. Il existe probablement déjà',
            ]);
        }
    }

    public function edit(string $id)
    {
        $typeCulture = TypeCulture::findOrFail($id);
        return view('pages.type-culture.edit', compact('typeCulture'));
    }

    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "libelle" => 'required|string|max:255|min:3',
        ], [
            "libelle.required" => "Le libelle est obligatoire",
            "libelle.max" => "Le libelle ne doit pas dépasser 255 caractères",
            "libelle.min" => "Le libelle doit contenir au moins 3 caractères"
        ]);
        try {
            TypeCulture::findOrFail($id)->update($fields);
            return redirect()->route('type-culture.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Type de culture créée avec succès',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la modification',
                'errorMessage' => 'Ce type de culture n\'a pas pu être modifié, car un autre type de culture porte déjà ce nom.',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $typeCulture = TypeCulture::findOrFail($id);
        if ($typeCulture->culture()->exists()) {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la suppression',
                'errorMessage' => 'Cet élément ne peux pas être supprimé car il est lié à un autre élément',
            ]);
        } else {
            $typeCulture->delete();
            return back()->with([
                'showSuccessModal' => true,
                'successTitle' => 'Suppression réussie',
                'successMessage' => 'Le type de culture a bien été supprimé',
            ]);
        }
    }
}
