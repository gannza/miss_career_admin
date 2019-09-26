<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseEntryRptsApiTest extends TestCase
{
    use MakeWarehouseEntryRptsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->fakeWarehouseEntryRptsData();
        $this->json('POST', '/api/v1/warehouseEntryRpts', $warehouseEntryRpts);

        $this->assertApiResponse($warehouseEntryRpts);
    }

    /**
     * @test
     */
    public function testReadWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->makeWarehouseEntryRpts();
        $this->json('GET', '/api/v1/warehouseEntryRpts/'.$warehouseEntryRpts->id);

        $this->assertApiResponse($warehouseEntryRpts->toArray());
    }

    /**
     * @test
     */
    public function testUpdateWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->makeWarehouseEntryRpts();
        $editedWarehouseEntryRpts = $this->fakeWarehouseEntryRptsData();

        $this->json('PUT', '/api/v1/warehouseEntryRpts/'.$warehouseEntryRpts->id, $editedWarehouseEntryRpts);

        $this->assertApiResponse($editedWarehouseEntryRpts);
    }

    /**
     * @test
     */
    public function testDeleteWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->makeWarehouseEntryRpts();
        $this->json('DELETE', '/api/v1/warehouseEntryRpts/'.$warehouseEntryRpts->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/warehouseEntryRpts/'.$warehouseEntryRpts->id);

        $this->assertResponseStatus(404);
    }
}
