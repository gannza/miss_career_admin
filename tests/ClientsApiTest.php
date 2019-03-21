<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientsApiTest extends TestCase
{
    use MakeClientsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateClients()
    {
        $clients = $this->fakeClientsData();
        $this->json('POST', '/api/v1/clients', $clients);

        $this->assertApiResponse($clients);
    }

    /**
     * @test
     */
    public function testReadClients()
    {
        $clients = $this->makeClients();
        $this->json('GET', '/api/v1/clients/'.$clients->id);

        $this->assertApiResponse($clients->toArray());
    }

    /**
     * @test
     */
    public function testUpdateClients()
    {
        $clients = $this->makeClients();
        $editedClients = $this->fakeClientsData();

        $this->json('PUT', '/api/v1/clients/'.$clients->id, $editedClients);

        $this->assertApiResponse($editedClients);
    }

    /**
     * @test
     */
    public function testDeleteClients()
    {
        $clients = $this->makeClients();
        $this->json('DELETE', '/api/v1/clients/'.$clients->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/clients/'.$clients->id);

        $this->assertResponseStatus(404);
    }
}
