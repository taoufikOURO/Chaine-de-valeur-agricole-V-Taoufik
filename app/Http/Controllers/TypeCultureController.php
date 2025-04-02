<?php

namespace App\Http\Controllers;

use App\Models\TypeCulture;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeCultureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.type-culture.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        if (TypeCulture::create($fields)) {
            return back()->with([
                'showSuccessModal' => true,
                'successTitle' => 'Opération réussie',
                'successMessage' => 'Type de culture créée avec succès',
            ]);
        } else {
            return back()->with([
                'showErrorModal' => true,
                'errorTitle' => 'Erreur de création',
                'errorMessage' => 'Veuillez vérifier le libelle'
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
