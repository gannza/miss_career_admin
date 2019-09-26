<?php

use App\Models\SalesItems;
use App\Repositories\SalesItemsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesItemsRepositoryTest extends TestCase
{
    use MakeSalesItemsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SalesItemsRepository
     */
    protected $salesItemsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->salesItemsRepo = App::make(SalesItemsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSalesItems()
    {
        $salesItems = $this->fakeSalesItemsData();
        $createdSalesItems = $this->salesItemsRepo->create($salesItems);
        $createdSalesItems = $createdSalesItems->toArray();
        $this->assertArrayHasKey('id', $createdSalesItems);
        $this->assertNotNull($createdSalesItems['id'], 'Created SalesItems must have id specified');
        $this->assertNotNull(SalesItems::find($createdSalesItems['id']), 'SalesItems with given id must be in DB');
        $this->assertModelData($salesItems, $createdSalesItems);
    }

    /**
     * @test read
     */
    public function testReadSalesItems()
    {
        $salesItems = $this->makeSalesItems();
        $dbSalesItems = $this->salesItemsRepo->find($salesItems->id);
        $dbSalesItems = $dbSalesItems->toArray();
        $this->assertModelData($salesItems->toArray(), $dbSalesItems);
    }

    /**
     * @test update
     */
    public function testUpdateSalesItems()
    {
        $salesItems = $this->makeSalesItems();
        $fakeSalesItems = $this->fakeSalesItemsData();
        $updatedSalesItems = $this->salesItemsRepo->update($fakeSalesItems, $salesItems->id);
        $this->assertModelData($fakeSalesItems, $updatedSalesItems->toArray());
        $dbSalesItems = $this->salesItemsRepo->find($salesItems->id);
        $this->assertModelData($fakeSalesItems, $dbSalesItems->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSalesItems()
    {
        $salesItems = $this->makeSalesItems();
        $resp = $this->salesItemsRepo->delete($salesItems->id);
        $this->assertTrue($resp);
        $this->assertNull(SalesItems::find($salesItems->id), 'SalesItems should not exist in DB');
    }
}
