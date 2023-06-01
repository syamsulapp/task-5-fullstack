<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */



    //  public function testLogin()


    // {
    //    $email = Config::get('api.apiEmail');
    //     $password = Config::get('api.apiPassword');

    //     $response = $this->json('POST', $baseUrl . '/', [
    //         'email' => $email,
    //         'password' => $password
    //     ]);

    //     $response
    //         ->assertStatus(200)
    //         ->assertJsonStructure([
    //             'access_token', 'token_type', 'expires_in'
    //         ]);
    // }      $baseUrl = Config::get('app.url') . '/api/auth/login';


    // public function testGet()
    // {
    //     $this->get('/articles')
    //         ->assertStatus(200);
    // }
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }
}
