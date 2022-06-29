<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/* Extending the TestCase class. */

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The login screen can be rendered.
     */
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * "Users can authenticate using the login screen."
     *
     * The first line of the function is a comment. It's a one sentence summary of the function. It's a
     * good idea to write this comment before you write the function. It helps you to focus on what
     * you're trying to test
     */
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * "Users can not authenticate with invalid password."
     *
     * The first line of the function is a comment. It's a good idea to include a comment at the top of
     * each test function that describes what the test is doing
     */
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
