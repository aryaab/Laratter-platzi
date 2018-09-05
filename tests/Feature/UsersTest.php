<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

use App\User;

class UsersTest extends TestCase
{

    use DatabaseTransactions;
    use InteractsWithDatabase;

    public function testCanSeeUserPage()
    {
        //Paso 1: Arrange | Preparación

        //Paso 2: Act | Acción

        //Paso 3: Assert | Verificación

        $user = factory(User::class)->create();

        $response = $this->get($user->username);

        $response->assertSee($user->username);
        // $response->assertSee($user->name);
    }

    public function testCanLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function testCanFollow()
    {
        $user = factory(User::class)->create();
        $other = factory(User::class)->create();

        $repsonse = $this->actingAs($user)->post($other->username.'/follow');

        $this->assertDatabaseHas('followers', [
            'user_id' => $user->id,
            'followed_id' => $other->id,
        ]);


    }

}
