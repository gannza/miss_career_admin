<?php

use App\Models\Clients;
use App\Repositories\ClientsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientsRepositoryTest extends TestCase
{
    use MakeClientsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClientsRepository
     */
    protected $clientsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->clientsRepo = App::make(ClientsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateClients()
    {
        $clients = $this->fakeClientsData();
        $createdClients = $this->clientsRepo->create($clients);
        $createdClients = $createdClients->toArray();
        $this->assertArrayHasKey('id', $createdClients);
        $this->assertNotNull($createdClients['id'], 'Created Clients must have id specified');
        $this->assertNotNull(Clients::find($createdClients['id']), 'Clients with given id must be in DB');
        $this->assertModelData($clients, $createdClients);
    }

    /**
     * @test read
     */
    public function testReadClients()
    {
        $clients = $this->makeClients();
        $dbClients = $this->clientsRepo->find($clients->id);
        $dbClients = $dbClients->toArray();
        $this->assertModelData($clients->toArray(), $dbClients);
    }

    /**
     * @test update
     */
    public function testUpdateClients()
    {
        $clients = $this->makeClients();
        $fakeClients = $this->fakeClientsData();
        $updatedClients = $this->clientsRepo->update($fakeClients, $clients->id);
        $this->assertModelData($fakeClients, $updatedClients->toArray());
        $dbClients = $this->clientsRepo->find($clients->id);
        $this->assertModelData($fakeClients, $dbClients->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteClients()
    {
        $clients = $this->makeClients();
        $resp = $this->clientsRepo->delete($clients->id);
        $this->assertTrue($resp);
        $this->assertNull(Clients::find($clients->id), 'Clients should not exist in DB');
    }
}
