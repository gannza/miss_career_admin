<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetailStockEntryRptsApiTest extends TestCase
{
    use MakeRetailStockEntryRptsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->fakeRetailStockEntryRptsData();
        $this->json('POST', '/api/v1/retailStockEntryRpts', $retailStockEntryRpts);

        $this->assertApiResponse($retailStockEntryRpts);
    }

    /**
     * @test
     */
    public function testReadRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->makeRetailStockEntryRpts();
        $this->json('GET', '/api/v1/retailStockEntryRpts/'.$retailStockEntryRpts->id);

        $this->assertApiResponse($retailStockEntryRpts->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->makeRetailStockEntryRpts();
        $editedRetailStockEntryRpts = $this->fakeRetailStockEntryRptsData();

        $this->json('PUT', '/api/v1/retailStockEntryRpts/'.$retailStockEntryRpts->id, $editedRetailStockEntryRpts);

        $this->assertApiResponse($editedRetailStockEntryRpts);
    }

    /**
     * @test
     */
    public function testDeleteRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->makeRetailStockEntryRpts();
        $this->json('DELETE', '/api/v1/retailStockEntryRpts/'.$retailStockEntryRpts->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/retailStockEntryRpts/'.$retailStockEntryRpts->id);

        $this->assertResponseStatus(404);
    }
}
