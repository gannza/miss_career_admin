<?php

use App\Models\stockMovements;
use App\Repositories\stockMovementsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class stockMovementsRepositoryTest extends TestCase
{
    use MakestockMovementsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var stockMovementsRepository
     */
    protected $stockMovementsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->stockMovementsRepo = App::make(stockMovementsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatestockMovements()
    {
        $stockMovements = $this->fakestockMovementsData();
        $createdstockMovements = $this->stockMovementsRepo->create($stockMovements);
        $createdstockMovements = $createdstockMovements->toArray();
        $this->assertArrayHasKey('id', $createdstockMovements);
        $this->assertNotNull($createdstockMovements['id'], 'Created stockMovements must have id specified');
        $this->assertNotNull(stockMovements::find($createdstockMovements['id']), 'stockMovements with given id must be in DB');
        $this->assertModelData($stockMovements, $createdstockMovements);
    }

    /**
     * @test read
     */
    public function testReadstockMovements()
    {
        $stockMovements = $this->makestockMovements();
        $dbstockMovements = $this->stockMovementsRepo->find($stockMovements->id);
        $dbstockMovements = $dbstockMovements->toArray();
        $this->assertModelData($stockMovements->toArray(), $dbstockMovements);
    }

    /**
     * @test update
     */
    public function testUpdatestockMovements()
    {
        $stockMovements = $this->makestockMovements();
        $fakestockMovements = $this->fakestockMovementsData();
        $updatedstockMovements = $this->stockMovementsRepo->update($fakestockMovements, $stockMovements->id);
        $this->assertModelData($fakestockMovements, $updatedstockMovements->toArray());
        $dbstockMovements = $this->stockMovementsRepo->find($stockMovements->id);
        $this->assertModelData($fakestockMovements, $dbstockMovements->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletestockMovements()
    {
        $stockMovements = $this->makestockMovements();
        $resp = $this->stockMovementsRepo->delete($stockMovements->id);
        $this->assertTrue($resp);
        $this->assertNull(stockMovements::find($stockMovements->id), 'stockMovements should not exist in DB');
    }
}
