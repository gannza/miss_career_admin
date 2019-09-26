<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseTransctionApiTest extends TestCase
{
    use MakeWarehouseTransctionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateWarehouseTransction()
    {
        $warehouseTransction = $this->fakeWarehouseTransctionData();
        $this->json('POST', '/api/v1/warehouseTransctions', $warehouseTransction);

        $this->assertApiResponse($warehouseTransction);
    }

    /**
     * @test
     */
    public function testReadWarehouseTransction()
    {
        $warehouseTransction = $this->makeWarehouseTransction();
        $this->json('GET', '/api/v1/warehouseTransctions/'.$warehouseTransction->id);

        $this->assertApiResponse($warehouseTransction->toArray());
    }

    /**
     * @test
     */
    public function testUpdateWarehouseTransction()
    {
        $warehouseTransction = $this->makeWarehouseTransction();
        $editedWarehouseTransction = $this->fakeWarehouseTransctionData();

        $this->json('PUT', '/api/v1/warehouseTransctions/'.$warehouseTransction->id, $editedWarehouseTransction);

        $this->assertApiResponse($editedWarehouseTransction);
    }

    /**
     * @test
     */
    public function testDeleteWarehouseTransction()
    {
        $warehouseTransction = $this->makeWarehouseTransction();
        $this->json('DELETE', '/api/v1/warehouseTransctions/'.$warehouseTransction->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/warehouseTransctions/'.$warehouseTransction->id);

        $this->assertResponseStatus(404);
    }
}
