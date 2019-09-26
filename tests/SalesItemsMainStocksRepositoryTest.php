<?php

use App\Models\SalesItemsMainStocks;
use App\Repositories\SalesItemsMainStocksRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesItemsMainStocksRepositoryTest extends TestCase
{
    use MakeSalesItemsMainStocksTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SalesItemsMainStocksRepository
     */
    protected $salesItemsMainStocksRepo;

    public function setUp()
    {
        parent::setUp();
        $this->salesItemsMainStocksRepo = App::make(SalesItemsMainStocksRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->fakeSalesItemsMainStocksData();
        $createdSalesItemsMainStocks = $this->salesItemsMainStocksRepo->create($salesItemsMainStocks);
        $createdSalesItemsMainStocks = $createdSalesItemsMainStocks->toArray();
        $this->assertArrayHasKey('id', $createdSalesItemsMainStocks);
        $this->assertNotNull($createdSalesItemsMainStocks['id'], 'Created SalesItemsMainStocks must have id specified');
        $this->assertNotNull(SalesItemsMainStocks::find($createdSalesItemsMainStocks['id']), 'SalesItemsMainStocks with given id must be in DB');
        $this->assertModelData($salesItemsMainStocks, $createdSalesItemsMainStocks);
    }

    /**
     * @test read
     */
    public function testReadSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->makeSalesItemsMainStocks();
        $dbSalesItemsMainStocks = $this->salesItemsMainStocksRepo->find($salesItemsMainStocks->id);
        $dbSalesItemsMainStocks = $dbSalesItemsMainStocks->toArray();
        $this->assertModelData($salesItemsMainStocks->toArray(), $dbSalesItemsMainStocks);
    }

    /**
     * @test update
     */
    public function testUpdateSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->makeSalesItemsMainStocks();
        $fakeSalesItemsMainStocks = $this->fakeSalesItemsMainStocksData();
        $updatedSalesItemsMainStocks = $this->salesItemsMainStocksRepo->update($fakeSalesItemsMainStocks, $salesItemsMainStocks->id);
        $this->assertModelData($fakeSalesItemsMainStocks, $updatedSalesItemsMainStocks->toArray());
        $dbSalesItemsMainStocks = $this->salesItemsMainStocksRepo->find($salesItemsMainStocks->id);
        $this->assertModelData($fakeSalesItemsMainStocks, $dbSalesItemsMainStocks->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSalesItemsMainStocks()
    {
        $salesItemsMainStocks = $this->makeSalesItemsMainStocks();
        $resp = $this->salesItemsMainStocksRepo->delete($salesItemsMainStocks->id);
        $this->assertTrue($resp);
        $this->assertNull(SalesItemsMainStocks::find($salesItemsMainStocks->id), 'SalesItemsMainStocks should not exist in DB');
    }
}
