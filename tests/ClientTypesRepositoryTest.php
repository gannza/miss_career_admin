<?php

use App\Models\ClientTypes;
use App\Repositories\ClientTypesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTypesRepositoryTest extends TestCase
{
    use MakeClientTypesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClientTypesRepository
     */
    protected $clientTypesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->clientTypesRepo = App::make(ClientTypesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateClientTypes()
    {
        $clientTypes = $this->fakeClientTypesData();
        $createdClientTypes = $this->clientTypesRepo->create($clientTypes);
        $createdClientTypes = $createdClientTypes->toArray();
        $this->assertArrayHasKey('id', $createdClientTypes);
        $this->assertNotNull($createdClientTypes['id'], 'Created ClientTypes must have id specified');
        $this->assertNotNull(ClientTypes::find($createdClientTypes['id']), 'ClientTypes with given id must be in DB');
        $this->assertModelData($clientTypes, $createdClientTypes);
    }

    /**
     * @test read
     */
    public function testReadClientTypes()
    {
        $clientTypes = $this->makeClientTypes();
        $dbClientTypes = $this->clientTypesRepo->find($clientTypes->id);
        $dbClientTypes = $dbClientTypes->toArray();
        $this->assertModelData($clientTypes->toArray(), $dbClientTypes);
    }

    /**
     * @test update
     */
    public function testUpdateClientTypes()
    {
        $clientTypes = $this->makeClientTypes();
        $fakeClientTypes = $this->fakeClientTypesData();
        $updatedClientTypes = $this->clientTypesRepo->update($fakeClientTypes, $clientTypes->id);
        $this->assertModelData($fakeClientTypes, $updatedClientTypes->toArray());
        $dbClientTypes = $this->clientTypesRepo->find($clientTypes->id);
        $this->assertModelData($fakeClientTypes, $dbClientTypes->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteClientTypes()
    {
        $clientTypes = $this->makeClientTypes();
        $resp = $this->clientTypesRepo->delete($clientTypes->id);
        $this->assertTrue($resp);
        $this->assertNull(ClientTypes::find($clientTypes->id), 'ClientTypes should not exist in DB');
    }
}
