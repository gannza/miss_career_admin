<?php

use Faker\Factory as Faker;
use App\Models\Sales;
use App\Repositories\SalesRepository;

trait MakeSalesTrait
{
    /**
     * Create fake instance of Sales and save it in database
     *
     * @param array $salesFields
     * @return Sales
     */
    public function makeSales($salesFields = [])
    {
        /** @var SalesRepository $salesRepo */
        $salesRepo = App::make(SalesRepository::class);
        $theme = $this->fakeSalesData($salesFields);
        return $salesRepo->create($theme);
    }

    /**
     * Get fake instance of Sales
     *
     * @param array $salesFields
     * @return Sales
     */
    public function fakeSales($salesFields = [])
    {
        return new Sales($this->fakeSalesData($salesFields));
    }

    /**
     * Get fake data of Sales
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSalesData($salesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'invoice_date' => $fake->word,
            'payment_date' => $fake->word,
            'total_amount' => $fake->randomDigitNotNull,
            'amount_due' => $fake->randomDigitNotNull,
            'tax_rate' => $fake->randomDigitNotNull,
            'customer_id' => $fake->randomDigitNotNull,
            'branch_id' => $fake->randomDigitNotNull,
            'operator_id' => $fake->randomDigitNotNull,
            'payment_method' => $fake->word,
            'payment_status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $salesFields);
    }
}
