<?php

namespace Tests\Feature\Login;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
    }

    /** @test  */
    public function reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test  */
    public function reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/password/reset/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    /** @test  */
    public function password_can_be_reset_with_valid_token()
    {
        //$this->markTestIncomplete();

        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post(route('password.update'), [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
