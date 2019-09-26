<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetailSalesReportsApiTest extends TestCase
{
    use MakeRetailSalesReportsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRetailSalesReports()
    {
        $retailSalesReports = $this->fakeRetailSalesReportsData();
        $this->json('POST', '/api/v1/retailSalesReports', $retailSalesReports);

        $this->assertApiResponse($retailSalesReports);
    }

    /**
     * @test
     */
    public function testReadRetailSalesReports()
    {
        $retailSalesReports = $this->makeRetailSalesReports();
        $this->json('GET', '/api/v1/retailSalesReports/'.$retailSalesReports->id);

        $this->assertApiResponse($retailSalesReports->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRetailSalesReports()
    {
        $retailSalesReports = $this->makeRetailSalesReports();
        $editedRetailSalesReports = $this->fakeRetailSalesReportsData();

        $this->json('PUT', '/api/v1/retailSalesReports/'.$retailSalesReports->id, $editedRetailSalesReports);

        $this->assertApiResponse($editedRetailSalesReports);
    }

    /**
     * @test
     */
    public function testDeleteRetailSalesReports()
    {
        $retailSalesReports = $this->makeRetailSalesReports();
        $this->json('DELETE', '/api/v1/retailSalesReports/'.$retailSalesReports->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/retailSalesReports/'.$retailSalesReports->id);

        $this->assertResponseStatus(404);
    }
}
