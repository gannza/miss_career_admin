<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseApiTest extends TestCase
{
    use MakeWarehouseTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateWarehouse()
    {
        $warehouse = $this->fakeWarehouseData();
        $this->json('POST', '/api/v1/warehouses', $warehouse);

        $this->assertApiResponse($warehouse);
    }

    /**
     * @test
     */
    public function testReadWarehouse()
    {
        $warehouse = $this->makeWarehouse();
        $this->json('GET', '/api/v1/warehouses/'.$warehouse->id);

        $this->assertApiResponse($warehouse->toArray());
    }

    /**
     * @test
     */
    public function testUpdateWarehouse()
    {
        $warehouse = $this->makeWarehouse();
        $editedWarehouse = $this->fakeWarehouseData();

        $this->json('PUT', '/api/v1/warehouses/'.$warehouse->id, $editedWarehouse);

        $this->assertApiResponse($editedWarehouse);
    }

    /**
     * @test
     */
    public function testDeleteWarehouse()
    {
        $warehouse = $this->makeWarehouse();
        $this->json('DELETE', '/api/v1/warehouses/'.$warehouse->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/warehouses/'.$warehouse->id);

        $this->assertResponseStatus(404);
    }
}
