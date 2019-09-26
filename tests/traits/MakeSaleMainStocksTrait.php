<?php

use Faker\Factory as Faker;
use App\Models\SaleMainStocks;
use App\Repositories\SaleMainStocksRepository;

trait MakeSaleMainStocksTrait
{
    /**
     * Create fake instance of SaleMainStocks and save it in database
     *
     * @param array $saleMainStocksFields
     * @return SaleMainStocks
     */
    public function makeSaleMainStocks($saleMainStocksFields = [])
    {
        /** @var SaleMainStocksRepository $saleMainStocksRepo */
        $saleMainStocksRepo = App::make(SaleMainStocksRepository::class);
        $theme = $this->fakeSaleMainStocksData($saleMainStocksFields);
        return $saleMainStocksRepo->create($theme);
    }

    /**
     * Get fake instance of SaleMainStocks
     *
     * @param array $saleMainStocksFields
     * @return SaleMainStocks
     */
    public function fakeSaleMainStocks($saleMainStocksFields = [])
    {
        return new SaleMainStocks($this->fakeSaleMainStocksData($saleMainStocksFields));
    }

    /**
     * Get fake data of SaleMainStocks
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSaleMainStocksData($saleMainStocksFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'invoice_date' => $fake->word,
            'payment_date' => $fake->word,
            'total_amount' => $fake->randomDigitNotNull,
            'amount_due' => $fake->randomDigitNotNull,
            'tax_rate' => $fake->randomDigitNotNull,
            'currency' => $fake->word,
            'customer_id' => $fake->randomDigitNotNull,
            'operator_id' => $fake->randomDigitNotNull,
            'payment_method' => $fake->word,
            'payment_status' => $fake->word,
            'saler_type' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $saleMainStocksFields);
    }
}
