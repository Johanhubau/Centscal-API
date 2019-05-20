<?php

namespace Tests\Feature;

use Tests\TestCase;

class EventTest extends TestCase
{

    public function testStore()
    {
        $this->postJson('/api/register', [
            'name' => 'Event McTest',
            'email' => 'event@mctest.com',
            'password' => 'secret',
            'c_password' => 'secret'
        ]);
        $response = $this->postJson('/api/login', [
            'email' => 'event@mctest.com',
            'password' => 'secret'
        ]);
        //Get token to update association
        $token = json_decode($response->content())->success->token;
        $response = $this->post('/api/events/', [
            'title' => 'Test Event',
            'asso_id' => '2',
            'start' => '2019-05-02 12:15:00',
            'end' => '2019-05-02 12:30:00'
        ], [
            "Authorization" => "Bearer " . $token,
            "Content-Type" => "application/x-www-form-urlencoded"
        ]);
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'event@mctest.com',
            'password' => 'secret'
        ]);
        //Get token to update association
        $token = json_decode($response->content())->success->token;

        $response = $this->put('/api/events/1', [
            'title' => 'Test updated Event',
            'start' => '2019-05-02 12:14:00',
            'end' => '2019-05-02 12:31:00'
        ], [
            "Authorization" => "Bearer " . $token,
            "Content-Type" => "application/x-www-form-urlencoded"
        ]);
        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $response = $this->getJson('/api/events', [
            'start' => '2019-04-29T00:00:00+02:00',
            'end' => '2019-05-30T00:00:00+02:00'
        ]);
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
        $response = $this->getJson('/api/events/1');
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
            'email' => 'event@mctest.com',
            'password' => 'secret'
        ]);
        //Get token to delete association
        $token = json_decode($response->content())->success->token;
        $response = $this->deleteJson('/api/events/1', [], ["Authorization" => "Bearer " . $token]);
        $response->assertStatus(200);
    }
}
