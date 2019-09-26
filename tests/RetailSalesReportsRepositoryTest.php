<?php

use App\Models\RetailSalesReports;
use App\Repositories\RetailSalesReportsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetailSalesReportsRepositoryTest extends TestCase
{
    use MakeRetailSalesReportsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RetailSalesReportsRepository
     */
    protected $retailSalesReportsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->retailSalesReportsRepo = App::make(RetailSalesReportsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRetailSalesReports()
    {
        $retailSalesReports = $this->fakeRetailSalesReportsData();
        $createdRetailSalesReports = $this->retailSalesReportsRepo->create($retailSalesReports);
        $createdRetailSalesReports = $createdRetailSalesReports->toArray();
        $this->assertArrayHasKey('id', $createdRetailSalesReports);
        $this->assertNotNull($createdRetailSalesReports['id'], 'Created RetailSalesReports must have id specified');
        $this->assertNotNull(RetailSalesReports::find($createdRetailSalesReports['id']), 'RetailSalesReports with given id must be in DB');
        $this->assertModelData($retailSalesReports, $createdRetailSalesReports);
    }

    /**
     * @test read
     */
    public function testReadRetailSalesReports()
    {
        $retailSalesReports = $this->makeRetailSalesReports();
        $dbRetailSalesReports = $this->retailSalesReportsRepo->find($retailSalesReports->id);
        $dbRetailSalesReports = $dbRetailSalesReports->toArray();
        $this->assertModelData($retailSalesReports->toArray(), $dbRetailSalesReports);
    }

    /**
     * @test update
     */
    public function testUpdateRetailSalesReports()
    {
        $retailSalesReports = $this->makeRetailSalesReports();
        $fakeRetailSalesReports = $this->fakeRetailSalesReportsData();
        $updatedRetailSalesReports = $this->retailSalesReportsRepo->update($fakeRetailSalesReports, $retailSalesReports->id);
        $this->assertModelData($fakeRetailSalesReports, $updatedRetailSalesReports->toArray());
        $dbRetailSalesReports = $this->retailSalesReportsRepo->find($retailSalesReports->id);
        $this->assertModelData($fakeRetailSalesReports, $dbRetailSalesReports->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRetailSalesReports()
    {
        $retailSalesReports = $this->makeRetailSalesReports();
        $resp = $this->retailSalesReportsRepo->delete($retailSalesReports->id);
        $this->assertTrue($resp);
        $this->assertNull(RetailSalesReports::find($retailSalesReports->id), 'RetailSalesReports should not exist in DB');
    }
}
