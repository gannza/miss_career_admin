<?php

use Faker\Factory as Faker;
use App\Models\MainStock;
use App\Repositories\MainStockRepository;

trait MakeMainStockTrait
{
    /**
     * Create fake instance of MainStock and save it in database
     *
     * @param array $mainStockFields
     * @return MainStock
     */
    public function makeMainStock($mainStockFields = [])
    {
        /** @var MainStockRepository $mainStockRepo */
        $mainStockRepo = App::make(MainStockRepository::class);
        $theme = $this->fakeMainStockData($mainStockFields);
        return $mainStockRepo->create($theme);
    }

    /**
     * Get fake instance of MainStock
     *
     * @param array $mainStockFields
     * @return MainStock
     */
    public function fakeMainStock($mainStockFields = [])
    {
        return new MainStock($this->fakeMainStockData($mainStockFields));
    }

    /**
     * Get fake data of MainStock
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMainStockData($mainStockFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'qty' => $fake->randomDigitNotNull,
            'total_entered_qty' => $fake->randomDigitNotNull,
            'added_qty' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mainStockFields);
    }
}
