<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this
            ->json('GET', 'api/users', []);
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Usuarios obtenidos!',
            ]);

        $response = $this
            ->json('POST', 'api/users', [
                'email' => 'some@email.com',
                'password' => 'colombia1',
                'password_confirmation' =>  'colombia1'
            ]);

        $response->assertStatus(422);
    }
}
