<?php

namespace Tests\Feature;

use App\Models\Parcelle;
use App\Models\Recolte;
use App\Models\Semis;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Tests\TestCase;

class AgriculteurTest extends TestCase
{
    public function test_agriculteur_can_access_stats_agriculteur()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('stats.agriculteur'));
        $response->assertOk();
    }

    public function test_agriculteur_can_access_parcelle_index()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('parcelle.index'));
        $response->assertOk();
    }

    public function test_agriculteu_can_access_parcelle_create_form()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();

        $response = $this->actingAs($agriculteur)->get(route('parcelle.create'));

        $response->assertOk();
    }

    public function test_agriculteur_can_create_parcelle()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $data = [
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'surface' => 30,
            'adresse' => 'Lomé',
            'statut_id' => 3,
            'user_id' => 2
        ];
        $response = $this->actingAs($agriculteur)->post(route('parcelle.store'), $data);
        $response->assertRedirect(route('parcelle.index'));
    }
    public function test_agriculteur_can_access_edit_parcelle_page()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $parcelle = Parcelle::create([
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'surface' => 30,
            'adresse' => 'Lomé',
            'statut_id' => 3,
            'user_id' => 2
        ]);
        $response = $this->actingAs($agriculteur)->get(route('parcelle.edit', ['parcelle' => Crypt::encrypt($parcelle->id)]));
        $response->assertOk();
    }
    public function test_agriculteur_can_update_parcelle()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $parcelle = Parcelle::create([
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'surface' => 30,
            'adresse' => 'Lomé',
            'statut_id' => 3,
            'user_id' => 2
        ]);
        $updatedData = [
            'nom' => Str::random(10),
            'surface' => 30,
            'adresse' => 'Lomé',
            'statut_id' => 3,
        ];

        $response = $this->actingAs($agriculteur)->put(route('parcelle.update', $parcelle->id), $updatedData);

        $response->assertRedirect(route('parcelle.index'));
    }
    public function test_agriculteur_can_delete_parcelle()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $parcelle = Parcelle::create([
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'surface' => 30,
            'adresse' => 'Lomé',
            'statut_id' => 3,
            'user_id' => 2
        ]);
        $response = $this->actingAs($agriculteur)->delete(route('parcelle.destroy', $parcelle->id));
        $response->assertRedirect(route('parcelle.index'));
    }
    // ----------------------------------------------------------------
    // Tests pour les fonctionnalités liées aux semis
    // ----------------------------------------------------------------

    public function test_agriculteur_can_access_semis_index()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('semis.index'));
        $response->assertOk();
    }
    public function test_agriculteur_can_access_semis_history()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('historique.semis'));
        $response->assertOk();
    }

    public function test_agriculteur_can_access_semis_create_form()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('semis.create'));
        $response->assertOk();
    }
    public function test_agriculteur_can_create_semis()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $parcelle = Parcelle::whereIn('statut_id', [2, 3])->first();
        $data = [
            'culture_id' => rand(1, 25),
            'parcelle_id' => $parcelle->id,
            'user_id' => 2
        ];
        $response = $this->actingAs($agriculteur)->post(route('semis.store'), $data);
        $response->assertRedirect(route('semis.index'));
    }
    // ----------------------------------------------------------------
    // Tests pour les fonctionnalités liées aux recoltes
    // ----------------------------------------------------------------

    public function test_agriculteur_can_access_recoltes_index()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('recolte.index'));
        $response->assertOk();
    }
    public function test_agriculteur_can_access_recolte_create_form()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('recolte.create'));
        $response->assertOk();
    }
    public function test_agriculteur_can_create_recolte()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $semis = Semis::where('user_id', 2)
            ->where('recolte_id', null)
            ->first();
        $parcelle = Parcelle::where('id', $semis->parcelle_id)->first();
        $data = [
            'parcelle_id' => $parcelle->id,
            'user_id' => 2,
            'semis_id' => $semis->id,
            'quantite_recolte' => rand(1, 20),
        ];
        $parcelle->update([
            "statut_id" => 2,
        ]);
        $response = $this->actingAs($agriculteur)->post(route('recolte.store'), $data);
        $recolte = Recolte::where('semis_id', $semis->id)->latest()->first();
        $semis->update([
            'recolte_id' => $recolte->id,
        ]);
        $response->assertRedirect(route('recolte.index'));
    }
    // ----------------------------------------------------------------
    // Tests pour les fonctionnalités liées aux fertilisations
    // ----------------------------------------------------------------

    public function test_agriculteur_can_access_fertilisation_index()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('fertilisation.index'));
        $response->assertOk();
    }
    public function test_agriculteur_can_access_fertilisation_create_form()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('fertilisation.create'));
        $response->assertOk();
    }
    public function test_agriculteur_can_create_fertilisation()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $parcelle = Parcelle::where('statut_id', 3)->first();
        $data = [
            'parcelle_id' => $parcelle->id,
            'description' => Str::random(100),
            'user_id' => 2
        ];
        $response = $this->actingAs($agriculteur)->post(route('fertilisation.store'), $data);
        $response->assertRedirect(route('fertilisation.index'));
    }
    // ----------------------------------------------------------------
    // Tests pour les fonctionnalités lés à l'arrosage
    // ----------------------------------------------------------------
    public function test_agriculteur_can_access_arrosage_create_form()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('arrosage.create'));
        $response->assertOk();
    }
    public function test_agriculteur_can_create_arrosage()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $semis = Semis::where('recolte_id', NULL)->first();
        $data = [
            'semis_id' => $semis->id,
            'user_id' => 2,
        ];
        $response = $this->actingAs($agriculteur)->post(route('arrosage.store'), $data);
        $response->assertRedirect(route('semis.index'));
    }
    public function test_agriculteur_can_access_semis_non_arrose_page()
    {
        $agriculteur = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $agriculteur->email_verified_at = now();
        $agriculteur->save();
        $response = $this->actingAs($agriculteur)->get(route('semisNonArroses'));
        $response->assertOk();
    }
}
