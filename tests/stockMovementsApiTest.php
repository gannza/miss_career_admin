<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class stockMovementsApiTest extends TestCase
{
    use MakestockMovementsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatestockMovements()
    {
        $stockMovements = $this->fakestockMovementsData();
        $this->json('POST', '/api/v1/stockMovements', $stockMovements);

        $this->assertApiResponse($stockMovements);
    }

    /**
     * @test
     */
    public function testReadstockMovements()
    {
        $stockMovements = $this->makestockMovements();
        $this->json('GET', '/api/v1/stockMovements/'.$stockMovements->id);

        $this->assertApiResponse($stockMovements->toArray());
    }

    /**
     * @test
     */
    public function testUpdatestockMovements()
    {
        $stockMovements = $this->makestockMovements();
        $editedstockMovements = $this->fakestockMovementsData();

        $this->json('PUT', '/api/v1/stockMovements/'.$stockMovements->id, $editedstockMovements);

        $this->assertApiResponse($editedstockMovements);
    }

    /**
     * @test
     */
    public function testDeletestockMovements()
    {
        $stockMovements = $this->makestockMovements();
        $this->json('DELETE', '/api/v1/stockMovements/'.$stockMovements->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/stockMovements/'.$stockMovements->id);

        $this->assertResponseStatus(404);
    }
}
