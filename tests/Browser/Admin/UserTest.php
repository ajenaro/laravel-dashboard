<?php

namespace Tests\Browser\Admin;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test  */
    function a_user_can_be_created()
    {
        $user1 = factory(User::class)->create([
            'email' => 'user1@email.com'
        ]);

        $user2 = factory(User::class)->create([
            'email' => 'user2@email.com'
        ]);

        $this->browse(function (Browser $browser, $browser2) use($user1, $user2) {
            $browser->loginAs($user1)
                ->visit('admin/users/create')
                ->type('name', 'Antonio')
                ->type('email', 'antonio.jenaro@gmail.com')
                ->type('password', 'password')
                ->type('password_confirm', 'password')
                ->press('Crear Usuario')
                ;

            $browser2->loginAs($user2)
                ->visit('admin/users')
                ->assertSee('Antonio')
                ->assertSee('antonio.jenaro@gmail.com')
                ;
        });
    }

    /** @test  */
    function a_user_can_be_updated()
    {
        $user1 = factory(User::class)->create([
          'email' => 'user1@email.com'
      ]);

        $user2 = factory(User::class)->create([
          'email' => 'user2@email.com'
      ]);

        $this->browse(function (Browser $browser) use($user1, $user2) {
            $browser->loginAs($user2)
                ->visit('admin/users/'.$user1->id.'/edit')
                ->type('email', 'new_email@email.com')
                ->press('Editar Usuario')
                ->visit('admin/users/'.$user1->id)
                ->assertSee('new_email@email.com')
                //->screenshot('updated_successfull')
            ;
        });
    }
}
