<?php

namespace Tests\Feature;

use Tests\TestCase;

class AssociationTest extends TestCase
{

    public function testStore()
    {
        $this->postJson('/api/register', [
            'name' => 'Asso McTest',
            'email' => 'asso@mctest.com',
            'password' => 'secret',
            'c_password' => 'secret'
        ]);
        $response = $this->postJson('/api/login', [
            'email' => 'asso@mctest.com',
            'password' => 'secret'
        ]);
        //Get token to update association
        $token = json_decode($response->content())->success->token;
        $response = $this->postJson('/api/details', [], ["Authorization" => "Bearer " . $token]);
        $user_id = json_decode($response->content())->success->id;
        $response = $this->post('/api/associations/', [
            'name' => 'Test Association',
            'color' => '#000000',
            'user_id' => $user_id
        ], [
            "Authorization" => "Bearer " . $token,
            "Content-Type" => "application/x-www-form-urlencoded"
        ]);
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'asso@mctest.com',
            'password' => 'secret'
        ]);
        //Get token to update association
        $token = json_decode($response->content())->success->token;

        $response = $this->put('/api/association/1', [
            'name' => 'Test Update Association',
            'color' => '#101010',
        ], [
            "Authorization" => "Bearer " . $token,
            "Content-Type" => "application/x-www-form-urlencoded"
        ]);
        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $response = $this->getJson('/api/associations');
//        dd($response);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'color',
                'user_id',
                'created_at',
                'updated_at',
            ]);
    }

    public function testShow()
    {
        $response = $this->getJson('/api/associations/1');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'color',
                'user_id',
                'created_at',
                'updated_at',
            ]);
    }

    public function testDelete()
    {

        $response = $this->postJson('/api/login', [
            'email' => 'asso@mctest.com',
            'password' => 'secret'
        ]);
        //Get token to delete association
        $token = json_decode($response->content())->success->token;
        $response = $this->deleteJson('/api/associations/1', [], ["Authorization" => "Bearer " . $token]);
        $response->assertStatus(200);
    }
}
