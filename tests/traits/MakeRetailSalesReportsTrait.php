<?php

use Faker\Factory as Faker;
use App\Models\RetailSalesReports;
use App\Repositories\RetailSalesReportsRepository;

trait MakeRetailSalesReportsTrait
{
    /**
     * Create fake instance of RetailSalesReports and save it in database
     *
     * @param array $retailSalesReportsFields
     * @return RetailSalesReports
     */
    public function makeRetailSalesReports($retailSalesReportsFields = [])
    {
        /** @var RetailSalesReportsRepository $retailSalesReportsRepo */
        $retailSalesReportsRepo = App::make(RetailSalesReportsRepository::class);
        $theme = $this->fakeRetailSalesReportsData($retailSalesReportsFields);
        return $retailSalesReportsRepo->create($theme);
    }

    /**
     * Get fake instance of RetailSalesReports
     *
     * @param array $retailSalesReportsFields
     * @return RetailSalesReports
     */
    public function fakeRetailSalesReports($retailSalesReportsFields = [])
    {
        return new RetailSalesReports($this->fakeRetailSalesReportsData($retailSalesReportsFields));
    }

    /**
     * Get fake data of RetailSalesReports
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRetailSalesReportsData($retailSalesReportsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $retailSalesReportsFields);
    }
}
