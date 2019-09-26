<?php

use Faker\Factory as Faker;
use App\Models\Stocks;
use App\Repositories\StocksRepository;

trait MakeStocksTrait
{
    /**
     * Create fake instance of Stocks and save it in database
     *
     * @param array $stocksFields
     * @return Stocks
     */
    public function makeStocks($stocksFields = [])
    {
        /** @var StocksRepository $stocksRepo */
        $stocksRepo = App::make(StocksRepository::class);
        $theme = $this->fakeStocksData($stocksFields);
        return $stocksRepo->create($theme);
    }

    /**
     * Get fake instance of Stocks
     *
     * @param array $stocksFields
     * @return Stocks
     */
    public function fakeStocks($stocksFields = [])
    {
        return new Stocks($this->fakeStocksData($stocksFields));
    }

    /**
     * Get fake data of Stocks
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStocksData($stocksFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'total_entered_qty' => $fake->randomDigitNotNull,
            'qty' => $fake->randomDigitNotNull,
            'added_qty' => $fake->randomDigitNotNull,
            'model_id' => $fake->randomDigitNotNull,
            'branch_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $stocksFields);
    }
}
