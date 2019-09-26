<?php

use Faker\Factory as Faker;
use App\Models\ExportMainSales;
use App\Repositories\ExportMainSalesRepository;

trait MakeExportMainSalesTrait
{
    /**
     * Create fake instance of ExportMainSales and save it in database
     *
     * @param array $exportMainSalesFields
     * @return ExportMainSales
     */
    public function makeExportMainSales($exportMainSalesFields = [])
    {
        /** @var ExportMainSalesRepository $exportMainSalesRepo */
        $exportMainSalesRepo = App::make(ExportMainSalesRepository::class);
        $theme = $this->fakeExportMainSalesData($exportMainSalesFields);
        return $exportMainSalesRepo->create($theme);
    }

    /**
     * Get fake instance of ExportMainSales
     *
     * @param array $exportMainSalesFields
     * @return ExportMainSales
     */
    public function fakeExportMainSales($exportMainSalesFields = [])
    {
        return new ExportMainSales($this->fakeExportMainSalesData($exportMainSalesFields));
    }

    /**
     * Get fake data of ExportMainSales
     *
     * @param array $postFields
     * @return array
     */
    public function fakeExportMainSalesData($exportMainSalesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $exportMainSalesFields);
    }
}
