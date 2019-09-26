<?php

use App\Models\SaleMainStocks;
use App\Repositories\SaleMainStocksRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SaleMainStocksRepositoryTest extends TestCase
{
    use MakeSaleMainStocksTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SaleMainStocksRepository
     */
    protected $saleMainStocksRepo;

    public function setUp()
    {
        parent::setUp();
        $this->saleMainStocksRepo = App::make(SaleMainStocksRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSaleMainStocks()
    {
        $saleMainStocks = $this->fakeSaleMainStocksData();
        $createdSaleMainStocks = $this->saleMainStocksRepo->create($saleMainStocks);
        $createdSaleMainStocks = $createdSaleMainStocks->toArray();
        $this->assertArrayHasKey('id', $createdSaleMainStocks);
        $this->assertNotNull($createdSaleMainStocks['id'], 'Created SaleMainStocks must have id specified');
        $this->assertNotNull(SaleMainStocks::find($createdSaleMainStocks['id']), 'SaleMainStocks with given id must be in DB');
        $this->assertModelData($saleMainStocks, $createdSaleMainStocks);
    }

    /**
     * @test read
     */
    public function testReadSaleMainStocks()
    {
        $saleMainStocks = $this->makeSaleMainStocks();
        $dbSaleMainStocks = $this->saleMainStocksRepo->find($saleMainStocks->id);
        $dbSaleMainStocks = $dbSaleMainStocks->toArray();
        $this->assertModelData($saleMainStocks->toArray(), $dbSaleMainStocks);
    }

    /**
     * @test update
     */
    public function testUpdateSaleMainStocks()
    {
        $saleMainStocks = $this->makeSaleMainStocks();
        $fakeSaleMainStocks = $this->fakeSaleMainStocksData();
        $updatedSaleMainStocks = $this->saleMainStocksRepo->update($fakeSaleMainStocks, $saleMainStocks->id);
        $this->assertModelData($fakeSaleMainStocks, $updatedSaleMainStocks->toArray());
        $dbSaleMainStocks = $this->saleMainStocksRepo->find($saleMainStocks->id);
        $this->assertModelData($fakeSaleMainStocks, $dbSaleMainStocks->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSaleMainStocks()
    {
        $saleMainStocks = $this->makeSaleMainStocks();
        $resp = $this->saleMainStocksRepo->delete($saleMainStocks->id);
        $this->assertTrue($resp);
        $this->assertNull(SaleMainStocks::find($saleMainStocks->id), 'SaleMainStocks should not exist in DB');
    }
}
