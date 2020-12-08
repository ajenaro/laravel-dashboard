<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_users_list()
    {
        $userLogin = factory(User::class)->create();

        factory(User::class)->create([
             'name' => 'Joel'
         ]);

        factory(User::class)->create([
             'name' => 'Ellie',
         ]);

        $this->actingAs($userLogin)
            ->get('/admin/users')
            ->assertStatus(200)
            ->assertSee('Listado de Usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }

    /** @test */
    function it_paginates_the_users()
    {
        $userLogin = factory(User::class)->create([
             'name' => 'Decimoséptimo Usuario',
             'created_at' => now()->subDays(2),
         ]);

        factory(User::class)->create([
             'name' => 'Decimosexto Usuario',
             'created_at' => now()->subDays(3),
         ]);

        factory(User::class)->times(12)->create([
            'created_at' => now()->subDays(4),
        ]);

        factory(User::class)->create([
             'name' => 'Tercer Usuario',
             'created_at' => now()->subDays(5),
         ]);

        factory(User::class)->create([
             'name' => 'Segundo Usuario',
             'created_at' => now()->subDays(6),
         ]);

        factory(User::class)->create([
             'name' => 'Primer Usuario',
             'created_at' => now()->subWeek(),
         ]);

        $this->actingAs($userLogin)
            ->get('/admin/users')
            ->assertStatus(200)
            ->assertSee('Listado de Usuarios')
            ->assertSeeInOrder([
               'Decimoséptimo Usuario',
               'Decimosexto Usuario',
               'Tercer Usuario',
            ])
            ->assertDontSee('Segundo Usuario')
            ->assertDontSee('Primer Usuario')
        ;

        $this->get('/admin/users?page=2')
            ->assertSeeInOrder([
               'Segundo Usuario',
               'Primer Usuario',
            ])
            ->assertDontSee('Tercer Usuario')
        ;
    }
}
