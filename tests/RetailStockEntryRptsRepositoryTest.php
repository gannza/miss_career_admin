<?php

use App\Models\RetailStockEntryRpts;
use App\Repositories\RetailStockEntryRptsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetailStockEntryRptsRepositoryTest extends TestCase
{
    use MakeRetailStockEntryRptsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RetailStockEntryRptsRepository
     */
    protected $retailStockEntryRptsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->retailStockEntryRptsRepo = App::make(RetailStockEntryRptsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->fakeRetailStockEntryRptsData();
        $createdRetailStockEntryRpts = $this->retailStockEntryRptsRepo->create($retailStockEntryRpts);
        $createdRetailStockEntryRpts = $createdRetailStockEntryRpts->toArray();
        $this->assertArrayHasKey('id', $createdRetailStockEntryRpts);
        $this->assertNotNull($createdRetailStockEntryRpts['id'], 'Created RetailStockEntryRpts must have id specified');
        $this->assertNotNull(RetailStockEntryRpts::find($createdRetailStockEntryRpts['id']), 'RetailStockEntryRpts with given id must be in DB');
        $this->assertModelData($retailStockEntryRpts, $createdRetailStockEntryRpts);
    }

    /**
     * @test read
     */
    public function testReadRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->makeRetailStockEntryRpts();
        $dbRetailStockEntryRpts = $this->retailStockEntryRptsRepo->find($retailStockEntryRpts->id);
        $dbRetailStockEntryRpts = $dbRetailStockEntryRpts->toArray();
        $this->assertModelData($retailStockEntryRpts->toArray(), $dbRetailStockEntryRpts);
    }

    /**
     * @test update
     */
    public function testUpdateRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->makeRetailStockEntryRpts();
        $fakeRetailStockEntryRpts = $this->fakeRetailStockEntryRptsData();
        $updatedRetailStockEntryRpts = $this->retailStockEntryRptsRepo->update($fakeRetailStockEntryRpts, $retailStockEntryRpts->id);
        $this->assertModelData($fakeRetailStockEntryRpts, $updatedRetailStockEntryRpts->toArray());
        $dbRetailStockEntryRpts = $this->retailStockEntryRptsRepo->find($retailStockEntryRpts->id);
        $this->assertModelData($fakeRetailStockEntryRpts, $dbRetailStockEntryRpts->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRetailStockEntryRpts()
    {
        $retailStockEntryRpts = $this->makeRetailStockEntryRpts();
        $resp = $this->retailStockEntryRptsRepo->delete($retailStockEntryRpts->id);
        $this->assertTrue($resp);
        $this->assertNull(RetailStockEntryRpts::find($retailStockEntryRpts->id), 'RetailStockEntryRpts should not exist in DB');
    }
}
