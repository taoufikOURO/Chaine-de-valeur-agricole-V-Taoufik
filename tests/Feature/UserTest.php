<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
        $email = 'gear2mugiwara@gmail.com';
        $password = 'utilisateur1';
        $this->post(
            '/login',
            ['email' => $email, 'password' => $password]
        )->assertRedirect('/dashboard');
    }
    public function test_user_can_access_dashboard()
    {
        $user = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $user->email_verified_at = now();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertOk();
    }
    public function test_user_can_access_dashboard_charts()
    {
        $user = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $user->email_verified_at = now();
        $response = $this->actingAs($user)->get('/dashboard/charts');
        $response->assertOk();
    }
    public function test_user_can_access_profile_page()
    {
        $user = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $user->email_verified_at = now();
        $response = $this->actingAs($user)->get('/profile');
        $response->assertOk();
    }
    public function test_user_can_access_verify_email_form()
    {
        $user = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $response = $this->actingAs($user)->get('/email/verify');
        $response->assertOk();
    }
    public function test_user_can_verify_email_with_signed_url()
    {
        $user = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $signedUrl = url()->signedRoute('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->email)
        ]);
        $response = $this->actingAs($user)->get($signedUrl);
        $response->assertRedirect(route('dashboard'));
    }
    public function test_user_can_resend_verification_email()
    {
        $user = User::where('email', 'xiyim14198@exclussi.com')->first();

        // Annuler la vérification pour ce test
        $user->email_verified_at = null;
        $user->save();

        // Désactiver le middleware throttle uniquement pour ce test
        $response = $this->actingAs($user)
            ->withoutMiddleware('throttle:6,1')
            ->post(route('verification.send'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_logout()
    {
        $this->post('/logout')->assertRedirect('/login');
    }

    public function test_user_can_access_forgot_password_form()
    {
        $this->get(route('password.request'))->assertStatus(200);
    }

    public function test_user_can_submit_forgot_password_form()
    {
        $email = 'gear2mugiwara@gmail.com';
        $response = $this->post(route('password.email'), [
            'email' => $email,
        ]);
        $response->assertStatus(302); // redirection
    }

    public function test_user_can_access_reset_password_form()
    {
        $token = 'test-token-123';
        $response = $this->get(route('password.reset', ['token' => $token]));
        $response->assertStatus(200);
    }

    public function test_user_can_submit_reset_password_form()
    {
        $user = User::where('email', 'gear2mugiwara@gmail.com')->first();
        $token = Password::createToken($user);
        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'utilisateur1',
            'password_confirmation' => 'utilisateur1',
        ]);
        $response->assertRedirect(route('login.page'));
    }
}
