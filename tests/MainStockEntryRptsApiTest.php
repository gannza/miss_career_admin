<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainStockEntryRptsApiTest extends TestCase
{
    use MakeMainStockEntryRptsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->fakeMainStockEntryRptsData();
        $this->json('POST', '/api/v1/mainStockEntryRpts', $mainStockEntryRpts);

        $this->assertApiResponse($mainStockEntryRpts);
    }

    /**
     * @test
     */
    public function testReadMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->makeMainStockEntryRpts();
        $this->json('GET', '/api/v1/mainStockEntryRpts/'.$mainStockEntryRpts->id);

        $this->assertApiResponse($mainStockEntryRpts->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->makeMainStockEntryRpts();
        $editedMainStockEntryRpts = $this->fakeMainStockEntryRptsData();

        $this->json('PUT', '/api/v1/mainStockEntryRpts/'.$mainStockEntryRpts->id, $editedMainStockEntryRpts);

        $this->assertApiResponse($editedMainStockEntryRpts);
    }

    /**
     * @test
     */
    public function testDeleteMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->makeMainStockEntryRpts();
        $this->json('DELETE', '/api/v1/mainStockEntryRpts/'.$mainStockEntryRpts->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/mainStockEntryRpts/'.$mainStockEntryRpts->id);

        $this->assertResponseStatus(404);
    }
}
