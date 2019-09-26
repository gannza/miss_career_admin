<?php

use App\Models\Sales;
use App\Repositories\SalesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesRepositoryTest extends TestCase
{
    use MakeSalesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SalesRepository
     */
    protected $salesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->salesRepo = App::make(SalesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSales()
    {
        $sales = $this->fakeSalesData();
        $createdSales = $this->salesRepo->create($sales);
        $createdSales = $createdSales->toArray();
        $this->assertArrayHasKey('id', $createdSales);
        $this->assertNotNull($createdSales['id'], 'Created Sales must have id specified');
        $this->assertNotNull(Sales::find($createdSales['id']), 'Sales with given id must be in DB');
        $this->assertModelData($sales, $createdSales);
    }

    /**
     * @test read
     */
    public function testReadSales()
    {
        $sales = $this->makeSales();
        $dbSales = $this->salesRepo->find($sales->id);
        $dbSales = $dbSales->toArray();
        $this->assertModelData($sales->toArray(), $dbSales);
    }

    /**
     * @test update
     */
    public function testUpdateSales()
    {
        $sales = $this->makeSales();
        $fakeSales = $this->fakeSalesData();
        $updatedSales = $this->salesRepo->update($fakeSales, $sales->id);
        $this->assertModelData($fakeSales, $updatedSales->toArray());
        $dbSales = $this->salesRepo->find($sales->id);
        $this->assertModelData($fakeSales, $dbSales->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSales()
    {
        $sales = $this->makeSales();
        $resp = $this->salesRepo->delete($sales->id);
        $this->assertTrue($resp);
        $this->assertNull(Sales::find($sales->id), 'Sales should not exist in DB');
    }
}
