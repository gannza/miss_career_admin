<?php

use App\Models\ExportMainSales;
use App\Repositories\ExportMainSalesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExportMainSalesRepositoryTest extends TestCase
{
    use MakeExportMainSalesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExportMainSalesRepository
     */
    protected $exportMainSalesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->exportMainSalesRepo = App::make(ExportMainSalesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateExportMainSales()
    {
        $exportMainSales = $this->fakeExportMainSalesData();
        $createdExportMainSales = $this->exportMainSalesRepo->create($exportMainSales);
        $createdExportMainSales = $createdExportMainSales->toArray();
        $this->assertArrayHasKey('id', $createdExportMainSales);
        $this->assertNotNull($createdExportMainSales['id'], 'Created ExportMainSales must have id specified');
        $this->assertNotNull(ExportMainSales::find($createdExportMainSales['id']), 'ExportMainSales with given id must be in DB');
        $this->assertModelData($exportMainSales, $createdExportMainSales);
    }

    /**
     * @test read
     */
    public function testReadExportMainSales()
    {
        $exportMainSales = $this->makeExportMainSales();
        $dbExportMainSales = $this->exportMainSalesRepo->find($exportMainSales->id);
        $dbExportMainSales = $dbExportMainSales->toArray();
        $this->assertModelData($exportMainSales->toArray(), $dbExportMainSales);
    }

    /**
     * @test update
     */
    public function testUpdateExportMainSales()
    {
        $exportMainSales = $this->makeExportMainSales();
        $fakeExportMainSales = $this->fakeExportMainSalesData();
        $updatedExportMainSales = $this->exportMainSalesRepo->update($fakeExportMainSales, $exportMainSales->id);
        $this->assertModelData($fakeExportMainSales, $updatedExportMainSales->toArray());
        $dbExportMainSales = $this->exportMainSalesRepo->find($exportMainSales->id);
        $this->assertModelData($fakeExportMainSales, $dbExportMainSales->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteExportMainSales()
    {
        $exportMainSales = $this->makeExportMainSales();
        $resp = $this->exportMainSalesRepo->delete($exportMainSales->id);
        $this->assertTrue($resp);
        $this->assertNull(ExportMainSales::find($exportMainSales->id), 'ExportMainSales should not exist in DB');
    }
}
