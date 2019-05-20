<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{

    public function testRegister()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'User McTest',
            'email' => 'user@mctest.com',
            'password' => 'secret',
            'c_password' => 'secret'
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success' => [
                    'token',
                    'name'
                ]
            ]);
    }

    public function testLogin()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'user@mctest.com',
            'password' => 'secret',
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure(['success' => [
                'token',
            ]]);
    }

    public function testDetails()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'user@mctest.com',
            'password' => 'secret',
        ]);
        $token = $response->content();
        $token = json_decode($token)->success->token;
        $response = $this->postJson('/api/details', [], ["Authorization" => "Bearer " . $token]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'is_admin',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testLogout()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'user@mctest.com',
            'password' => 'secret',
        ]);
        $token = $response->content();
        $token = json_decode($token)->success->token;
        $response = $this->postJson('/api/logout', [], ["Authorization" => "Bearer " . $token]);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
