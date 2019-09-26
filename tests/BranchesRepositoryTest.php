<?php

use App\Models\Branches;
use App\Repositories\BranchesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BranchesRepositoryTest extends TestCase
{
    use MakeBranchesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BranchesRepository
     */
    protected $branchesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->branchesRepo = App::make(BranchesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBranches()
    {
        $branches = $this->fakeBranchesData();
        $createdBranches = $this->branchesRepo->create($branches);
        $createdBranches = $createdBranches->toArray();
        $this->assertArrayHasKey('id', $createdBranches);
        $this->assertNotNull($createdBranches['id'], 'Created Branches must have id specified');
        $this->assertNotNull(Branches::find($createdBranches['id']), 'Branches with given id must be in DB');
        $this->assertModelData($branches, $createdBranches);
    }

    /**
     * @test read
     */
    public function testReadBranches()
    {
        $branches = $this->makeBranches();
        $dbBranches = $this->branchesRepo->find($branches->id);
        $dbBranches = $dbBranches->toArray();
        $this->assertModelData($branches->toArray(), $dbBranches);
    }

    /**
     * @test update
     */
    public function testUpdateBranches()
    {
        $branches = $this->makeBranches();
        $fakeBranches = $this->fakeBranchesData();
        $updatedBranches = $this->branchesRepo->update($fakeBranches, $branches->id);
        $this->assertModelData($fakeBranches, $updatedBranches->toArray());
        $dbBranches = $this->branchesRepo->find($branches->id);
        $this->assertModelData($fakeBranches, $dbBranches->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBranches()
    {
        $branches = $this->makeBranches();
        $resp = $this->branchesRepo->delete($branches->id);
        $this->assertTrue($resp);
        $this->assertNull(Branches::find($branches->id), 'Branches should not exist in DB');
    }
}
