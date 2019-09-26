<?php

use App\Models\Models;
use App\Repositories\ModelsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModelsRepositoryTest extends TestCase
{
    use MakeModelsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ModelsRepository
     */
    protected $modelsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->modelsRepo = App::make(ModelsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateModels()
    {
        $models = $this->fakeModelsData();
        $createdModels = $this->modelsRepo->create($models);
        $createdModels = $createdModels->toArray();
        $this->assertArrayHasKey('id', $createdModels);
        $this->assertNotNull($createdModels['id'], 'Created Models must have id specified');
        $this->assertNotNull(Models::find($createdModels['id']), 'Models with given id must be in DB');
        $this->assertModelData($models, $createdModels);
    }

    /**
     * @test read
     */
    public function testReadModels()
    {
        $models = $this->makeModels();
        $dbModels = $this->modelsRepo->find($models->id);
        $dbModels = $dbModels->toArray();
        $this->assertModelData($models->toArray(), $dbModels);
    }

    /**
     * @test update
     */
    public function testUpdateModels()
    {
        $models = $this->makeModels();
        $fakeModels = $this->fakeModelsData();
        $updatedModels = $this->modelsRepo->update($fakeModels, $models->id);
        $this->assertModelData($fakeModels, $updatedModels->toArray());
        $dbModels = $this->modelsRepo->find($models->id);
        $this->assertModelData($fakeModels, $dbModels->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteModels()
    {
        $models = $this->makeModels();
        $resp = $this->modelsRepo->delete($models->id);
        $this->assertTrue($resp);
        $this->assertNull(Models::find($models->id), 'Models should not exist in DB');
    }
}
