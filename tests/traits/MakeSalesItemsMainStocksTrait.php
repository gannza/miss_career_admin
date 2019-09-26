<?php

use Faker\Factory as Faker;
use App\Models\SalesItemsMainStocks;
use App\Repositories\SalesItemsMainStocksRepository;

trait MakeSalesItemsMainStocksTrait
{
    /**
     * Create fake instance of SalesItemsMainStocks and save it in database
     *
     * @param array $salesItemsMainStocksFields
     * @return SalesItemsMainStocks
     */
    public function makeSalesItemsMainStocks($salesItemsMainStocksFields = [])
    {
        /** @var SalesItemsMainStocksRepository $salesItemsMainStocksRepo */
        $salesItemsMainStocksRepo = App::make(SalesItemsMainStocksRepository::class);
        $theme = $this->fakeSalesItemsMainStocksData($salesItemsMainStocksFields);
        return $salesItemsMainStocksRepo->create($theme);
    }

    /**
     * Get fake instance of SalesItemsMainStocks
     *
     * @param array $salesItemsMainStocksFields
     * @return SalesItemsMainStocks
     */
    public function fakeSalesItemsMainStocks($salesItemsMainStocksFields = [])
    {
        return new SalesItemsMainStocks($this->fakeSalesItemsMainStocksData($salesItemsMainStocksFields));
    }

    /**
     * Get fake data of SalesItemsMainStocks
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSalesItemsMainStocksData($salesItemsMainStocksFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'model_id' => $fake->randomDigitNotNull,
            'sale_id' => $fake->randomDigitNotNull,
            'price' => $fake->randomDigitNotNull,
            'qty' => $fake->randomDigitNotNull,
            'total' => $fake->randomDigitNotNull,
            'sale_type' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $salesItemsMainStocksFields);
    }
}
