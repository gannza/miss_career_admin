<?php

use App\Models\items;
use App\Repositories\itemsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class itemsRepositoryTest extends TestCase
{
    use MakeitemsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var itemsRepository
     */
    protected $itemsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->itemsRepo = App::make(itemsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateitems()
    {
        $items = $this->fakeitemsData();
        $createditems = $this->itemsRepo->create($items);
        $createditems = $createditems->toArray();
        $this->assertArrayHasKey('id', $createditems);
        $this->assertNotNull($createditems['id'], 'Created items must have id specified');
        $this->assertNotNull(items::find($createditems['id']), 'items with given id must be in DB');
        $this->assertModelData($items, $createditems);
    }

    /**
     * @test read
     */
    public function testReaditems()
    {
        $items = $this->makeitems();
        $dbitems = $this->itemsRepo->find($items->id);
        $dbitems = $dbitems->toArray();
        $this->assertModelData($items->toArray(), $dbitems);
    }

    /**
     * @test update
     */
    public function testUpdateitems()
    {
        $items = $this->makeitems();
        $fakeitems = $this->fakeitemsData();
        $updateditems = $this->itemsRepo->update($fakeitems, $items->id);
        $this->assertModelData($fakeitems, $updateditems->toArray());
        $dbitems = $this->itemsRepo->find($items->id);
        $this->assertModelData($fakeitems, $dbitems->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteitems()
    {
        $items = $this->makeitems();
        $resp = $this->itemsRepo->delete($items->id);
        $this->assertTrue($resp);
        $this->assertNull(items::find($items->id), 'items should not exist in DB');
    }
}
