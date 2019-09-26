<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StocksApiTest extends TestCase
{
    use MakeStocksTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStocks()
    {
        $stocks = $this->fakeStocksData();
        $this->json('POST', '/api/v1/stocks', $stocks);

        $this->assertApiResponse($stocks);
    }

    /**
     * @test
     */
    public function testReadStocks()
    {
        $stocks = $this->makeStocks();
        $this->json('GET', '/api/v1/stocks/'.$stocks->id);

        $this->assertApiResponse($stocks->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStocks()
    {
        $stocks = $this->makeStocks();
        $editedStocks = $this->fakeStocksData();

        $this->json('PUT', '/api/v1/stocks/'.$stocks->id, $editedStocks);

        $this->assertApiResponse($editedStocks);
    }

    /**
     * @test
     */
    public function testDeleteStocks()
    {
        $stocks = $this->makeStocks();
        $this->json('DELETE', '/api/v1/stocks/'.$stocks->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/stocks/'.$stocks->id);

        $this->assertResponseStatus(404);
    }
}
