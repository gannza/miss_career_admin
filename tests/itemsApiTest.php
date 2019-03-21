<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class itemsApiTest extends TestCase
{
    use MakeitemsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateitems()
    {
        $items = $this->fakeitemsData();
        $this->json('POST', '/api/v1/items', $items);

        $this->assertApiResponse($items);
    }

    /**
     * @test
     */
    public function testReaditems()
    {
        $items = $this->makeitems();
        $this->json('GET', '/api/v1/items/'.$items->id);

        $this->assertApiResponse($items->toArray());
    }

    /**
     * @test
     */
    public function testUpdateitems()
    {
        $items = $this->makeitems();
        $editeditems = $this->fakeitemsData();

        $this->json('PUT', '/api/v1/items/'.$items->id, $editeditems);

        $this->assertApiResponse($editeditems);
    }

    /**
     * @test
     */
    public function testDeleteitems()
    {
        $items = $this->makeitems();
        $this->json('DELETE', '/api/v1/items/'.$items->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/items/'.$items->id);

        $this->assertResponseStatus(404);
    }
}
