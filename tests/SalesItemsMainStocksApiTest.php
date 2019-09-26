<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesItemsMainStocksApiTest extends TestCase
{
    use MakeSalesItemsMainStocksTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->fakeSalesItemsMainStocksData();
        $this->json('POST', '/api/v1/salesItemsMainStocks', $salesItemsMainStocks);

        $this->assertApiResponse($salesItemsMainStocks);
    }

    /**
     * @test
     */
    public function testReadSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->makeSalesItemsMainStocks();
        $this->json('GET', '/api/v1/salesItemsMainStocks/'.$salesItemsMainStocks->id);

        $this->assertApiResponse($salesItemsMainStocks->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->makeSalesItemsMainStocks();
        $editedSalesItemsMainStocks = $this->fakeSalesItemsMainStocksData();

        $this->json('PUT', '/api/v1/salesItemsMainStocks/'.$salesItemsMainStocks->id, $editedSalesItemsMainStocks);

        $this->assertApiResponse($editedSalesItemsMainStocks);
    }

    /**
     * @test
     */
    public function testDeleteSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->makeSalesItemsMainStocks();
        $this->json('DELETE', '/api/v1/salesItemsMainStocks/'.$salesItemsMainStocks->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/salesItemsMainStocks/'.$salesItemsMainStocks->id);

        $this->assertResponseStatus(404);
    }
}
