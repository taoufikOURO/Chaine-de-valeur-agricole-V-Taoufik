<?php

namespace App\Http\Controllers;

use App\Models\Parcelle;
use App\Models\Statut;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class ParcelleController extends Controller
{
    public function index()
    {
        #recupérer selon un id
        $parcelles = Parcelle::where('user_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->withCount('fertilisation')
            ->paginate(10);
        return view('pages.parcelle.index', compact('parcelles'));
    }

    public function create()
    {
        $statuts = Statut::all();
        return view('pages.parcelle.create', compact('statuts'));
    }

    public function checkCity($city)
    {
        $url = "https://nominatim.openstreetmap.org/search";
        $response = Http::withHeaders([
            'User-Agent' => 'LaravelApp/1.0'
        ])->get($url, [
            'q' => $city,
            'format' => 'json',
            'limit' => 1,
        ]);

        //dd($response->json());
        $data = $response->json();

        if (!empty($data)) {
            return $data[0];
        }

        return null;
    }
    public function store(Request $request)
    {
        $fields = $request->validate(
            [
                "nom" => 'required|string|max:255|min:3',
                "surface" => 'required|numeric|min:0.01|max:100',
                "adresse" => 'required|string|max:255|min:3',
                "statut_id" => 'required',
            ],
            [
                "nom.required" => "Le libelle est obligatoire",
                "nom.max" => "Le libelle ne doit pas dépasser 255 caractères",
                "nom.min" => "Le libelle doit contenir au moins 3 caractères",

                "surface.required" => "La surface est obligatoire",
                "surface.numeric" => "La surface doit être un nombre",
                "surface.min" => "La surface doit être supérieure à 0.01 hectare, soit 100 m²",
                "surface.max" => "La surface ne doit pas dépasser 100 hectare, soit 1 Km²",
                "adresse.required" => "L'adresse est obligatoire",

                "adresse.max" => "L'adresse ne doit pas dépasser 255 caractères",
                "adresse.min" => "L'adresse doit contenir au moins 3 caractères",

                "statut_id.required" => "Le statut est obligatoire",
            ]
        );
        $fields['code'] = Str::uuid()->toString();
        $fields['user_id'] = Auth::user()->id;
        $data = $this->checkCity($fields['adresse']);

        if ($data) {
            try {
                $fields['adresse'] = $data['name'];
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
                    'errorMessage' => 'Une erreur est survenue lors de la création de la parcelle. Veuillez réessayer.',
                ]);
            }
        } else {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la création',
                'errorMessage' => 'Veuillez saisir une adresse valide. Ce lieux n\'existe pas',
            ]);
        }
    }

    public function edit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
            $parcelle = Parcelle::findOrFail($id);
            $statuts = Statut::all();
            return view(
                'pages.parcelle.edit',
                compact('parcelle', 'statuts')
            );
        } catch (Exception $e) {
            return redirect()->route('parcelle.index')->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur de récupération de la parcelle',
                'errorMessage' => 'Cette parcelle n\'a pas pu être récupérée. Veuillez réessayer plus tard',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "nom" => 'required|string|max:255|min:3',
            "surface" => 'required|numeric',
            "adresse" => 'required|string|max:255|min:3',
            "statut_id" => "nullable",
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
                'errorMessage' => 'Une erreur est survenue lors de la modification de la parcelle',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        if ($parcelle->semis()->exists() || $parcelle->fertilisation()->exists() || $parcelle->recolte()->exists()) {
            return redirect()->route('parcelle.index')->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur lors de la suppression',
                'errorMessage' => 'Cet élément ne peux pas être supprimé car il est lié à un autre élément',
            ]);
        } else {
            $parcelle->delete();
            return redirect()->route('parcelle.index')->with([
                'showSuccessModal' => true,
                'successTitle' => 'Suppression réussie',
                'successMessage' => 'La parcelle a bien été supprimé',
            ]);
        }
    }
}
