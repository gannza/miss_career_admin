<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainStockTransctionsApiTest extends TestCase
{
    use MakeMainStockTransctionsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMainStockTransctions()
    {
        $mainStockTransctions = $this->fakeMainStockTransctionsData();
        $this->json('POST', '/api/v1/mainStockTransctions', $mainStockTransctions);

        $this->assertApiResponse($mainStockTransctions);
    }

    /**
     * @test
     */
    public function testReadMainStockTransctions()
    {
        $mainStockTransctions = $this->makeMainStockTransctions();
        $this->json('GET', '/api/v1/mainStockTransctions/'.$mainStockTransctions->id);

        $this->assertApiResponse($mainStockTransctions->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMainStockTransctions()
    {
        $mainStockTransctions = $this->makeMainStockTransctions();
        $editedMainStockTransctions = $this->fakeMainStockTransctionsData();

        $this->json('PUT', '/api/v1/mainStockTransctions/'.$mainStockTransctions->id, $editedMainStockTransctions);

        $this->assertApiResponse($editedMainStockTransctions);
    }

    /**
     * @test
     */
    public function testDeleteMainStockTransctions()
    {
        $mainStockTransctions = $this->makeMainStockTransctions();
        $this->json('DELETE', '/api/v1/mainStockTransctions/'.$mainStockTransctions->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/mainStockTransctions/'.$mainStockTransctions->id);

        $this->assertResponseStatus(404);
    }
}
