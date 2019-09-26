<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesApiTest extends TestCase
{
    use MakeSalesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSales()
    {
        $sales = $this->fakeSalesData();
        $this->json('POST', '/api/v1/sales', $sales);

        $this->assertApiResponse($sales);
    }

    /**
     * @test
     */
    public function testReadSales()
    {
        $sales = $this->makeSales();
        $this->json('GET', '/api/v1/sales/'.$sales->id);

        $this->assertApiResponse($sales->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSales()
    {
        $sales = $this->makeSales();
        $editedSales = $this->fakeSalesData();

        $this->json('PUT', '/api/v1/sales/'.$sales->id, $editedSales);

        $this->assertApiResponse($editedSales);
    }

    /**
     * @test
     */
    public function testDeleteSales()
    {
        $sales = $this->makeSales();
        $this->json('DELETE', '/api/v1/sales/'.$sales->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sales/'.$sales->id);

        $this->assertResponseStatus(404);
    }
}
