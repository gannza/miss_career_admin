<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrandsApiTest extends TestCase
{
    use MakeBrandsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBrands()
    {
        $brands = $this->fakeBrandsData();
        $this->json('POST', '/api/v1/brands', $brands);

        $this->assertApiResponse($brands);
    }

    /**
     * @test
     */
    public function testReadBrands()
    {
        $brands = $this->makeBrands();
        $this->json('GET', '/api/v1/brands/'.$brands->id);

        $this->assertApiResponse($brands->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBrands()
    {
        $brands = $this->makeBrands();
        $editedBrands = $this->fakeBrandsData();

        $this->json('PUT', '/api/v1/brands/'.$brands->id, $editedBrands);

        $this->assertApiResponse($editedBrands);
    }

    /**
     * @test
     */
    public function testDeleteBrands()
    {
        $brands = $this->makeBrands();
        $this->json('DELETE', '/api/v1/brands/'.$brands->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/brands/'.$brands->id);

        $this->assertResponseStatus(404);
    }
}
