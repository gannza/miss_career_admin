<?php

use App\Models\MainStockTransctions;
use App\Repositories\MainStockTransctionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainStockTransctionsRepositoryTest extends TestCase
{
    use MakeMainStockTransctionsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MainStockTransctionsRepository
     */
    protected $mainStockTransctionsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mainStockTransctionsRepo = App::make(MainStockTransctionsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMainStockTransctions()
    {
        $mainStockTransctions = $this->fakeMainStockTransctionsData();
        $createdMainStockTransctions = $this->mainStockTransctionsRepo->create($mainStockTransctions);
        $createdMainStockTransctions = $createdMainStockTransctions->toArray();
        $this->assertArrayHasKey('id', $createdMainStockTransctions);
        $this->assertNotNull($createdMainStockTransctions['id'], 'Created MainStockTransctions must have id specified');
        $this->assertNotNull(MainStockTransctions::find($createdMainStockTransctions['id']), 'MainStockTransctions with given id must be in DB');
        $this->assertModelData($mainStockTransctions, $createdMainStockTransctions);
    }

    /**
     * @test read
     */
    public function testReadMainStockTransctions()
    {
        $mainStockTransctions = $this->makeMainStockTransctions();
        $dbMainStockTransctions = $this->mainStockTransctionsRepo->find($mainStockTransctions->id);
        $dbMainStockTransctions = $dbMainStockTransctions->toArray();
        $this->assertModelData($mainStockTransctions->toArray(), $dbMainStockTransctions);
    }

    /**
     * @test update
     */
    public function testUpdateMainStockTransctions()
    {
        $mainStockTransctions = $this->makeMainStockTransctions();
        $fakeMainStockTransctions = $this->fakeMainStockTransctionsData();
        $updatedMainStockTransctions = $this->mainStockTransctionsRepo->update($fakeMainStockTransctions, $mainStockTransctions->id);
        $this->assertModelData($fakeMainStockTransctions, $updatedMainStockTransctions->toArray());
        $dbMainStockTransctions = $this->mainStockTransctionsRepo->find($mainStockTransctions->id);
        $this->assertModelData($fakeMainStockTransctions, $dbMainStockTransctions->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMainStockTransctions()
    {
        $mainStockTransctions = $this->makeMainStockTransctions();
        $resp = $this->mainStockTransctionsRepo->delete($mainStockTransctions->id);
        $this->assertTrue($resp);
        $this->assertNull(MainStockTransctions::find($mainStockTransctions->id), 'MainStockTransctions should not exist in DB');
    }
}
