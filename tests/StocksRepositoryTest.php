<?php

use App\Models\Stocks;
use App\Repositories\StocksRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StocksRepositoryTest extends TestCase
{
    use MakeStocksTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StocksRepository
     */
    protected $stocksRepo;

    public function setUp()
    {
        parent::setUp();
        $this->stocksRepo = App::make(StocksRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStocks()
    {
        $stocks = $this->fakeStocksData();
        $createdStocks = $this->stocksRepo->create($stocks);
        $createdStocks = $createdStocks->toArray();
        $this->assertArrayHasKey('id', $createdStocks);
        $this->assertNotNull($createdStocks['id'], 'Created Stocks must have id specified');
        $this->assertNotNull(Stocks::find($createdStocks['id']), 'Stocks with given id must be in DB');
        $this->assertModelData($stocks, $createdStocks);
    }

    /**
     * @test read
     */
    public function testReadStocks()
    {
        $stocks = $this->makeStocks();
        $dbStocks = $this->stocksRepo->find($stocks->id);
        $dbStocks = $dbStocks->toArray();
        $this->assertModelData($stocks->toArray(), $dbStocks);
    }

    /**
     * @test update
     */
    public function testUpdateStocks()
    {
        $stocks = $this->makeStocks();
        $fakeStocks = $this->fakeStocksData();
        $updatedStocks = $this->stocksRepo->update($fakeStocks, $stocks->id);
        $this->assertModelData($fakeStocks, $updatedStocks->toArray());
        $dbStocks = $this->stocksRepo->find($stocks->id);
        $this->assertModelData($fakeStocks, $dbStocks->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStocks()
    {
        $stocks = $this->makeStocks();
        $resp = $this->stocksRepo->delete($stocks->id);
        $this->assertTrue($resp);
        $this->assertNull(Stocks::find($stocks->id), 'Stocks should not exist in DB');
    }
}
