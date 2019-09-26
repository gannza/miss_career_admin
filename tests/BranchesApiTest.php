<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BranchesApiTest extends TestCase
{
    use MakeBranchesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBranches()
    {
        $branches = $this->fakeBranchesData();
        $this->json('POST', '/api/v1/branches', $branches);

        $this->assertApiResponse($branches);
    }

    /**
     * @test
     */
    public function testReadBranches()
    {
        $branches = $this->makeBranches();
        $this->json('GET', '/api/v1/branches/'.$branches->id);

        $this->assertApiResponse($branches->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBranches()
    {
        $branches = $this->makeBranches();
        $editedBranches = $this->fakeBranchesData();

        $this->json('PUT', '/api/v1/branches/'.$branches->id, $editedBranches);

        $this->assertApiResponse($editedBranches);
    }

    /**
     * @test
     */
    public function testDeleteBranches()
    {
        $branches = $this->makeBranches();
        $this->json('DELETE', '/api/v1/branches/'.$branches->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/branches/'.$branches->id);

        $this->assertResponseStatus(404);
    }
}
