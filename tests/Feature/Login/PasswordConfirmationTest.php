<?php

namespace Tests\Feature\Login;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function confirm_password_screen_can_be_rendered()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/password/confirm');

        $response->assertStatus(200);
    }

    /** @test  */
    public function password_can_be_confirmed()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /** @test  */
    public function password_is_not_confirmed_with_invalid_password()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
