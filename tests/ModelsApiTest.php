<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModelsApiTest extends TestCase
{
    use MakeModelsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateModels()
    {
        $models = $this->fakeModelsData();
        $this->json('POST', '/api/v1/models', $models);

        $this->assertApiResponse($models);
    }

    /**
     * @test
     */
    public function testReadModels()
    {
        $models = $this->makeModels();
        $this->json('GET', '/api/v1/models/'.$models->id);

        $this->assertApiResponse($models->toArray());
    }

    /**
     * @test
     */
    public function testUpdateModels()
    {
        $models = $this->makeModels();
        $editedModels = $this->fakeModelsData();

        $this->json('PUT', '/api/v1/models/'.$models->id, $editedModels);

        $this->assertApiResponse($editedModels);
    }

    /**
     * @test
     */
    public function testDeleteModels()
    {
        $models = $this->makeModels();
        $this->json('DELETE', '/api/v1/models/'.$models->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/models/'.$models->id);

        $this->assertResponseStatus(404);
    }
}
