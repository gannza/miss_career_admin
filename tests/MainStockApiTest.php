<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainStockApiTest extends TestCase
{
    use MakeMainStockTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMainStock()
    {
        $mainStock = $this->fakeMainStockData();
        $this->json('POST', '/api/v1/mainStocks', $mainStock);

        $this->assertApiResponse($mainStock);
    }

    /**
     * @test
     */
    public function testReadMainStock()
    {
        $mainStock = $this->makeMainStock();
        $this->json('GET', '/api/v1/mainStocks/'.$mainStock->id);

        $this->assertApiResponse($mainStock->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMainStock()
    {
        $mainStock = $this->makeMainStock();
        $editedMainStock = $this->fakeMainStockData();

        $this->json('PUT', '/api/v1/mainStocks/'.$mainStock->id, $editedMainStock);

        $this->assertApiResponse($editedMainStock);
    }

    /**
     * @test
     */
    public function testDeleteMainStock()
    {
        $mainStock = $this->makeMainStock();
        $this->json('DELETE', '/api/v1/mainStocks/'.$mainStock->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/mainStocks/'.$mainStock->id);

        $this->assertResponseStatus(404);
    }
}
