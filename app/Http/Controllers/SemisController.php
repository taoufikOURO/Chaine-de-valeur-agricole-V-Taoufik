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
    public function index()
    {
        $semis = Semis::where("user_id", Auth::user()->id)
            ->where('recolte_id', null)
            ->orderByDesc('created_at')
            ->withCount('arrosage')
            ->paginate(10);

        return view('pages.semis.index', compact('semis'));
    }
    public function historique()
    {
        $semis = Semis::where("user_id", Auth::user()->id)
            ->whereNot('recolte_id', null)
            ->orderByDesc('created_at')
            ->withCount('arrosage')
            ->paginate(10);
        return view('pages.semis.historique', compact('semis'));
    }

    public function create()
    {
        $cultures = Culture::orderByDesc('created_at')->get();
        $parcelles = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', 3)
            ->orderByDesc('created_at')
            ->get();
        return view('pages.semis.create', compact('cultures', 'parcelles'));
    }

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
}
