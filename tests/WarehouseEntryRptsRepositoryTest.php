<?php

use App\Models\WarehouseEntryRpts;
use App\Repositories\WarehouseEntryRptsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseEntryRptsRepositoryTest extends TestCase
{
    use MakeWarehouseEntryRptsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var WarehouseEntryRptsRepository
     */
    protected $warehouseEntryRptsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->warehouseEntryRptsRepo = App::make(WarehouseEntryRptsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->fakeWarehouseEntryRptsData();
        $createdWarehouseEntryRpts = $this->warehouseEntryRptsRepo->create($warehouseEntryRpts);
        $createdWarehouseEntryRpts = $createdWarehouseEntryRpts->toArray();
        $this->assertArrayHasKey('id', $createdWarehouseEntryRpts);
        $this->assertNotNull($createdWarehouseEntryRpts['id'], 'Created WarehouseEntryRpts must have id specified');
        $this->assertNotNull(WarehouseEntryRpts::find($createdWarehouseEntryRpts['id']), 'WarehouseEntryRpts with given id must be in DB');
        $this->assertModelData($warehouseEntryRpts, $createdWarehouseEntryRpts);
    }

    /**
     * @test read
     */
    public function testReadWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->makeWarehouseEntryRpts();
        $dbWarehouseEntryRpts = $this->warehouseEntryRptsRepo->find($warehouseEntryRpts->id);
        $dbWarehouseEntryRpts = $dbWarehouseEntryRpts->toArray();
        $this->assertModelData($warehouseEntryRpts->toArray(), $dbWarehouseEntryRpts);
    }

    /**
     * @test update
     */
    public function testUpdateWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->makeWarehouseEntryRpts();
        $fakeWarehouseEntryRpts = $this->fakeWarehouseEntryRptsData();
        $updatedWarehouseEntryRpts = $this->warehouseEntryRptsRepo->update($fakeWarehouseEntryRpts, $warehouseEntryRpts->id);
        $this->assertModelData($fakeWarehouseEntryRpts, $updatedWarehouseEntryRpts->toArray());
        $dbWarehouseEntryRpts = $this->warehouseEntryRptsRepo->find($warehouseEntryRpts->id);
        $this->assertModelData($fakeWarehouseEntryRpts, $dbWarehouseEntryRpts->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteWarehouseEntryRpts()
    {
        $warehouseEntryRpts = $this->makeWarehouseEntryRpts();
        $resp = $this->warehouseEntryRptsRepo->delete($warehouseEntryRpts->id);
        $this->assertTrue($resp);
        $this->assertNull(WarehouseEntryRpts::find($warehouseEntryRpts->id), 'WarehouseEntryRpts should not exist in DB');
    }
}
