<?php

use App\Models\WarehouseTransction;
use App\Repositories\WarehouseTransctionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseTransctionRepositoryTest extends TestCase
{
    use MakeWarehouseTransctionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var WarehouseTransctionRepository
     */
    protected $warehouseTransctionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->warehouseTransctionRepo = App::make(WarehouseTransctionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateWarehouseTransction()
    {
        $warehouseTransction = $this->fakeWarehouseTransctionData();
        $createdWarehouseTransction = $this->warehouseTransctionRepo->create($warehouseTransction);
        $createdWarehouseTransction = $createdWarehouseTransction->toArray();
        $this->assertArrayHasKey('id', $createdWarehouseTransction);
        $this->assertNotNull($createdWarehouseTransction['id'], 'Created WarehouseTransction must have id specified');
        $this->assertNotNull(WarehouseTransction::find($createdWarehouseTransction['id']), 'WarehouseTransction with given id must be in DB');
        $this->assertModelData($warehouseTransction, $createdWarehouseTransction);
    }

    /**
     * @test read
     */
    public function testReadWarehouseTransction()
    {
        $warehouseTransction = $this->makeWarehouseTransction();
        $dbWarehouseTransction = $this->warehouseTransctionRepo->find($warehouseTransction->id);
        $dbWarehouseTransction = $dbWarehouseTransction->toArray();
        $this->assertModelData($warehouseTransction->toArray(), $dbWarehouseTransction);
    }

    /**
     * @test update
     */
    public function testUpdateWarehouseTransction()
    {
        $warehouseTransction = $this->makeWarehouseTransction();
        $fakeWarehouseTransction = $this->fakeWarehouseTransctionData();
        $updatedWarehouseTransction = $this->warehouseTransctionRepo->update($fakeWarehouseTransction, $warehouseTransction->id);
        $this->assertModelData($fakeWarehouseTransction, $updatedWarehouseTransction->toArray());
        $dbWarehouseTransction = $this->warehouseTransctionRepo->find($warehouseTransction->id);
        $this->assertModelData($fakeWarehouseTransction, $dbWarehouseTransction->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteWarehouseTransction()
    {
        $warehouseTransction = $this->makeWarehouseTransction();
        $resp = $this->warehouseTransctionRepo->delete($warehouseTransction->id);
        $this->assertTrue($resp);
        $this->assertNull(WarehouseTransction::find($warehouseTransction->id), 'WarehouseTransction should not exist in DB');
    }
}
