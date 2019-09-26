<?php

use App\Models\Warehouse;
use App\Repositories\WarehouseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseRepositoryTest extends TestCase
{
    use MakeWarehouseTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var WarehouseRepository
     */
    protected $warehouseRepo;

    public function setUp()
    {
        parent::setUp();
        $this->warehouseRepo = App::make(WarehouseRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateWarehouse()
    {
        $warehouse = $this->fakeWarehouseData();
        $createdWarehouse = $this->warehouseRepo->create($warehouse);
        $createdWarehouse = $createdWarehouse->toArray();
        $this->assertArrayHasKey('id', $createdWarehouse);
        $this->assertNotNull($createdWarehouse['id'], 'Created Warehouse must have id specified');
        $this->assertNotNull(Warehouse::find($createdWarehouse['id']), 'Warehouse with given id must be in DB');
        $this->assertModelData($warehouse, $createdWarehouse);
    }

    /**
     * @test read
     */
    public function testReadWarehouse()
    {
        $warehouse = $this->makeWarehouse();
        $dbWarehouse = $this->warehouseRepo->find($warehouse->id);
        $dbWarehouse = $dbWarehouse->toArray();
        $this->assertModelData($warehouse->toArray(), $dbWarehouse);
    }

    /**
     * @test update
     */
    public function testUpdateWarehouse()
    {
        $warehouse = $this->makeWarehouse();
        $fakeWarehouse = $this->fakeWarehouseData();
        $updatedWarehouse = $this->warehouseRepo->update($fakeWarehouse, $warehouse->id);
        $this->assertModelData($fakeWarehouse, $updatedWarehouse->toArray());
        $dbWarehouse = $this->warehouseRepo->find($warehouse->id);
        $this->assertModelData($fakeWarehouse, $dbWarehouse->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteWarehouse()
    {
        $warehouse = $this->makeWarehouse();
        $resp = $this->warehouseRepo->delete($warehouse->id);
        $this->assertTrue($resp);
        $this->assertNull(Warehouse::find($warehouse->id), 'Warehouse should not exist in DB');
    }
}
