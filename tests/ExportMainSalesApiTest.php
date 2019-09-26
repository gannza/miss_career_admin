<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExportMainSalesApiTest extends TestCase
{
    use MakeExportMainSalesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateExportMainSales()
    {
        $exportMainSales = $this->fakeExportMainSalesData();
        $this->json('POST', '/api/v1/exportMainSales', $exportMainSales);

        $this->assertApiResponse($exportMainSales);
    }

    /**
     * @test
     */
    public function testReadExportMainSales()
    {
        $exportMainSales = $this->makeExportMainSales();
        $this->json('GET', '/api/v1/exportMainSales/'.$exportMainSales->id);

        $this->assertApiResponse($exportMainSales->toArray());
    }

    /**
     * @test
     */
    public function testUpdateExportMainSales()
    {
        $exportMainSales = $this->makeExportMainSales();
        $editedExportMainSales = $this->fakeExportMainSalesData();

        $this->json('PUT', '/api/v1/exportMainSales/'.$exportMainSales->id, $editedExportMainSales);

        $this->assertApiResponse($editedExportMainSales);
    }

    /**
     * @test
     */
    public function testDeleteExportMainSales()
    {
        $exportMainSales = $this->makeExportMainSales();
        $this->json('DELETE', '/api/v1/exportMainSales/'.$exportMainSales->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/exportMainSales/'.$exportMainSales->id);

        $this->assertResponseStatus(404);
    }
}
