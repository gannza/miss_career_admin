<?php

use App\Models\MainStockEntryRpts;
use App\Repositories\MainStockEntryRptsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainStockEntryRptsRepositoryTest extends TestCase
{
    use MakeMainStockEntryRptsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MainStockEntryRptsRepository
     */
    protected $mainStockEntryRptsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mainStockEntryRptsRepo = App::make(MainStockEntryRptsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->fakeMainStockEntryRptsData();
        $createdMainStockEntryRpts = $this->mainStockEntryRptsRepo->create($mainStockEntryRpts);
        $createdMainStockEntryRpts = $createdMainStockEntryRpts->toArray();
        $this->assertArrayHasKey('id', $createdMainStockEntryRpts);
        $this->assertNotNull($createdMainStockEntryRpts['id'], 'Created MainStockEntryRpts must have id specified');
        $this->assertNotNull(MainStockEntryRpts::find($createdMainStockEntryRpts['id']), 'MainStockEntryRpts with given id must be in DB');
        $this->assertModelData($mainStockEntryRpts, $createdMainStockEntryRpts);
    }

    /**
     * @test read
     */
    public function testReadMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->makeMainStockEntryRpts();
        $dbMainStockEntryRpts = $this->mainStockEntryRptsRepo->find($mainStockEntryRpts->id);
        $dbMainStockEntryRpts = $dbMainStockEntryRpts->toArray();
        $this->assertModelData($mainStockEntryRpts->toArray(), $dbMainStockEntryRpts);
    }

    /**
     * @test update
     */
    public function testUpdateMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->makeMainStockEntryRpts();
        $fakeMainStockEntryRpts = $this->fakeMainStockEntryRptsData();
        $updatedMainStockEntryRpts = $this->mainStockEntryRptsRepo->update($fakeMainStockEntryRpts, $mainStockEntryRpts->id);
        $this->assertModelData($fakeMainStockEntryRpts, $updatedMainStockEntryRpts->toArray());
        $dbMainStockEntryRpts = $this->mainStockEntryRptsRepo->find($mainStockEntryRpts->id);
        $this->assertModelData($fakeMainStockEntryRpts, $dbMainStockEntryRpts->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMainStockEntryRpts()
    {
        $mainStockEntryRpts = $this->makeMainStockEntryRpts();
        $resp = $this->mainStockEntryRptsRepo->delete($mainStockEntryRpts->id);
        $this->assertTrue($resp);
        $this->assertNull(MainStockEntryRpts::find($mainStockEntryRpts->id), 'MainStockEntryRpts should not exist in DB');
    }
}
