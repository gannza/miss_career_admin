<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTypesApiTest extends TestCase
{
    use MakeClientTypesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateClientTypes()
    {
        $clientTypes = $this->fakeClientTypesData();
        $this->json('POST', '/api/v1/clientTypes', $clientTypes);

        $this->assertApiResponse($clientTypes);
    }

    /**
     * @test
     */
    public function testReadClientTypes()
    {
        $clientTypes = $this->makeClientTypes();
        $this->json('GET', '/api/v1/clientTypes/'.$clientTypes->id);

        $this->assertApiResponse($clientTypes->toArray());
    }

    /**
     * @test
     */
    public function testUpdateClientTypes()
    {
        $clientTypes = $this->makeClientTypes();
        $editedClientTypes = $this->fakeClientTypesData();

        $this->json('PUT', '/api/v1/clientTypes/'.$clientTypes->id, $editedClientTypes);

        $this->assertApiResponse($editedClientTypes);
    }

    /**
     * @test
     */
    public function testDeleteClientTypes()
    {
        $clientTypes = $this->makeClientTypes();
        $this->json('DELETE', '/api/v1/clientTypes/'.$clientTypes->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/clientTypes/'.$clientTypes->id);

        $this->assertResponseStatus(404);
    }
}
