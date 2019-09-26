<?php

use App\Models\MainStock;
use App\Repositories\MainStockRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainStockRepositoryTest extends TestCase
{
    use MakeMainStockTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MainStockRepository
     */
    protected $mainStockRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mainStockRepo = App::make(MainStockRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMainStock()
    {
        $mainStock = $this->fakeMainStockData();
        $createdMainStock = $this->mainStockRepo->create($mainStock);
        $createdMainStock = $createdMainStock->toArray();
        $this->assertArrayHasKey('id', $createdMainStock);
        $this->assertNotNull($createdMainStock['id'], 'Created MainStock must have id specified');
        $this->assertNotNull(MainStock::find($createdMainStock['id']), 'MainStock with given id must be in DB');
        $this->assertModelData($mainStock, $createdMainStock);
    }

    /**
     * @test read
     */
    public function testReadMainStock()
    {
        $mainStock = $this->makeMainStock();
        $dbMainStock = $this->mainStockRepo->find($mainStock->id);
        $dbMainStock = $dbMainStock->toArray();
        $this->assertModelData($mainStock->toArray(), $dbMainStock);
    }

    /**
     * @test update
     */
    public function testUpdateMainStock()
    {
        $mainStock = $this->makeMainStock();
        $fakeMainStock = $this->fakeMainStockData();
        $updatedMainStock = $this->mainStockRepo->update($fakeMainStock, $mainStock->id);
        $this->assertModelData($fakeMainStock, $updatedMainStock->toArray());
        $dbMainStock = $this->mainStockRepo->find($mainStock->id);
        $this->assertModelData($fakeMainStock, $dbMainStock->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMainStock()
    {
        $mainStock = $this->makeMainStock();
        $resp = $this->mainStockRepo->delete($mainStock->id);
        $this->assertTrue($resp);
        $this->assertNull(MainStock::find($mainStock->id), 'MainStock should not exist in DB');
    }
}
