<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SaleMainStocksApiTest extends TestCase
{
    use MakeSaleMainStocksTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSaleMainStocks()
    {
        $saleMainStocks = $this->fakeSaleMainStocksData();
        $this->json('POST', '/api/v1/saleMainStocks', $saleMainStocks);

        $this->assertApiResponse($saleMainStocks);
    }

    /**
     * @test
     */
    public function testReadSaleMainStocks()
    {
        $saleMainStocks = $this->makeSaleMainStocks();
        $this->json('GET', '/api/v1/saleMainStocks/'.$saleMainStocks->id);

        $this->assertApiResponse($saleMainStocks->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSaleMainStocks()
    {
        $saleMainStocks = $this->makeSaleMainStocks();
        $editedSaleMainStocks = $this->fakeSaleMainStocksData();

        $this->json('PUT', '/api/v1/saleMainStocks/'.$saleMainStocks->id, $editedSaleMainStocks);

        $this->assertApiResponse($editedSaleMainStocks);
    }

    /**
     * @test
     */
    public function testDeleteSaleMainStocks()
    {
        $saleMainStocks = $this->makeSaleMainStocks();
        $this->json('DELETE', '/api/v1/saleMainStocks/'.$saleMainStocks->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/saleMainStocks/'.$saleMainStocks->id);

        $this->assertResponseStatus(404);
    }
}
