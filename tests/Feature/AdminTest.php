<?php

namespace Tests\Feature;

use App\Models\Culture;
use App\Models\TypeCulture;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_can_access_global_stats()
    {
        $admin = User::where(['email' => 'xiyim14198@exclussi.com'])->first();
        $admin->email_verified_at = now();
        $admin->save();
        $response = $this->actingAs($admin)->get(route('stats.global'));

        // Vérifier qu'il a bien accès (statut HTTP 200)
        $response->assertOk();
    }
    public function test_admin_can_access_culture_index()
    {
        $admin = User::where(['email' => 'xiyim14198@exclussi.com'])->first();
        $admin->email_verified_at = now();
        $admin->save();

        $response = $this->actingAs($admin)->get(route('culture.index'));

        $response->assertOk();
    }
    public function test_admin_can_access_culture_create_form()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $admin->email_verified_at = now();
        $admin->save();

        $response = $this->actingAs($admin)->get(route('culture.create'));

        $response->assertOk();
    }

    /* Ce test peut ne pas marcher si le random donne le même nom de culture .... le nom est unique donc.... */
    public function test_admin_can_create_culture()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $admin->email_verified_at = now();
        $admin->save();
        $data = [
            'nom' => Str::random(10),
            'type_culture_id' => 1,
        ];

        $response = $this->actingAs($admin)->post(route('culture.store'), $data);
        $response->assertRedirect(route('culture.index'));
    }

    public function test_admin_can_access_edit_culture_page()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();

        $culture = Culture::create([
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'type_culture_id' => 1,
        ]);
        $response = $this->actingAs($admin)->get(route('culture.edit', ['culture' => Crypt::encrypt($culture->id)]));

        $response->assertOk();
    }
    public function test_admin_can_update_culture()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        // Créer une culture existante
        $culture = Culture::create([
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'type_culture_id' => 1,
        ]);

        $updatedData = [
            'code' => Str::uuid()->toString(),
            'nom' => Str::random(10),
            'type_culture_id' => 1,
        ];

        $response = $this->actingAs($admin)->put(route('culture.update', $culture->id), $updatedData);

        $response->assertRedirect(route('culture.index'));
    }
    public function test_admin_can_delete_culture()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $culture = Culture::create([
            'code' => '1234567890',
            'nom' => 'Ma Culture à Supprimer',
            'type_culture_id' => 1,
        ]);

        $response = $this->actingAs($admin)->delete(route('culture.destroy', $culture->id));

        $response->assertRedirect(route('culture.index'));
    }
    // ----------------------------------------------------------------
    // Tests pour les fonctionnalités liées à TypeCulture (admin only)
    // ----------------------------------------------------------------

    public function test_admin_can_access_type_culture_index()
    {
        $admin = User::where(['email' => 'xiyim14198@exclussi.com'])->first();
        $admin->email_verified_at = now();
        $admin->save();

        $response = $this->actingAs($admin)->get(route('type-culture.index'));

        $response->assertOk();
    }
    public function test_admin_can_access_type_culture_create_form()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $admin->email_verified_at = now();
        $admin->save();

        $response = $this->actingAs($admin)->get(route('type-culture.create'));

        $response->assertOk();
    }
    public function test_admin_can_create_type_culture()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $admin->email_verified_at = now();
        $admin->save();
        $data = [
            'libelle' => Str::random(10),
        ];

        $response = $this->actingAs($admin)->post(route('type-culture.store'), $data);
        $response->assertRedirect(route('type-culture.index'));
    }
    public function test_admin_can_access_edit_type_culture_page()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();

        $typeCulture = TypeCulture::create([
            'code' => Str::uuid()->toString(),
            'libelle' => Str::random(10),
        ]);
        $response = $this->actingAs($admin)->get(route('type-culture.edit', ['type_culture' => Crypt::encrypt($typeCulture->id)]));

        $response->assertOk();
    }
    public function test_admin_can_update_type_culture()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        // Créer une culture existante
        $typeCulture = TypeCulture::create([
            'code' => Str::uuid()->toString(),
            'libelle' => Str::random(10),
        ]);

        $updatedData = [
            'code' => Str::uuid()->toString(),
            'libelle' => Str::random(10),
        ];

        $response = $this->actingAs($admin)->put(route('type-culture.update', $typeCulture->id), $updatedData);

        $response->assertRedirect(route('type-culture.index'));
    }
    public function test_admin_can_delete_type_culture()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $typeCulture = TypeCulture::create([
            'code' => '1234567890',
            'libelle' => 'Ma Culture à Supprimer',
        ]);

        $response = $this->actingAs($admin)->delete(route('type-culture.destroy', $typeCulture->id));

        $response->assertRedirect(route('type-culture.index'));
    }

    // ----------------------------------------------------------------
    // Tests pour les fonctionnalités liées aux utilisateurs
    // ----------------------------------------------------------------

    public function test_admin_can_access_user_index()
    {
        $admin = User::where(['email' => 'xiyim14198@exclussi.com'])->first();
        $admin->email_verified_at = now();
        $admin->save();

        $response = $this->actingAs($admin)->get(route('user.index'));

        $response->assertOk();
    }
    public function test_admin_can_access_user_create_form()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $admin->email_verified_at = now();
        $admin->save();

        $response = $this->actingAs($admin)->get(route('user.create'));

        $response->assertOk();
    }
    public function test_admin_can_create_user()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        $admin->email_verified_at = now();
        $admin->save();
        $data = [
            'username' => Str::random(10),
            'email' => Str::random(5) . '@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => (string) rand(10000000, 99999999),
            'role_id' => 1
        ];

        $response = $this->actingAs($admin)->post(route('user.store'), $data);
        $response->assertRedirect(route('user.index'));
    }
    public function test_admin_can_access_edit_user_page()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();

        $user = User::create([
            'username' => Str::random(10),
            'email' => Str::random(5) . '@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => (string) rand(10000000, 99999999),
            'role_id' => 1
        ]);
        $response = $this->actingAs($admin)->get(route('user.edit', ['user' => Crypt::encrypt($user->id)]));

        $response->assertOk();
    }
    public function test_admin_can_update_user()
    {
        $admin = User::where('email', 'xiyim14198@exclussi.com')->first();
        // Créer une culture existante
        $user = User::create([
            'username' => Str::random(10),
            'email' => Str::random(5) . '@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => (string) rand(10000000, 99999999),
            'role_id' => 1
        ]);

        $updatedData = [
            'username' => Str::random(10),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => (string) rand(10000000, 99999999),
            'role_id' => 1,
            'active' => false,
        ];

        $response = $this->actingAs($admin)->put(route('user.update', $user->id), $updatedData);

        $response->assertRedirect(route('user.index'));
    }
    
}
