<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesItemsApiTest extends TestCase
{
    use MakeSalesItemsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSalesItems()
    {
        $salesItems = $this->fakeSalesItemsData();
        $this->json('POST', '/api/v1/salesItems', $salesItems);

        $this->assertApiResponse($salesItems);
    }

    /**
     * @test
     */
    public function testReadSalesItems()
    {
        $salesItems = $this->makeSalesItems();
        $this->json('GET', '/api/v1/salesItems/'.$salesItems->id);

        $this->assertApiResponse($salesItems->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSalesItems()
    {
        $salesItems = $this->makeSalesItems();
        $editedSalesItems = $this->fakeSalesItemsData();

        $this->json('PUT', '/api/v1/salesItems/'.$salesItems->id, $editedSalesItems);

        $this->assertApiResponse($editedSalesItems);
    }

    /**
     * @test
     */
    public function testDeleteSalesItems()
    {
        $salesItems = $this->makeSalesItems();
        $this->json('DELETE', '/api/v1/salesItems/'.$salesItems->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/salesItems/'.$salesItems->id);

        $this->assertResponseStatus(404);
    }
}
