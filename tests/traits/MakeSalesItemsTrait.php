<?php

use Faker\Factory as Faker;
use App\Models\SalesItems;
use App\Repositories\SalesItemsRepository;

trait MakeSalesItemsTrait
{
    /**
     * Create fake instance of SalesItems and save it in database
     *
     * @param array $salesItemsFields
     * @return SalesItems
     */
    public function makeSalesItems($salesItemsFields = [])
    {
        /** @var SalesItemsRepository $salesItemsRepo */
        $salesItemsRepo = App::make(SalesItemsRepository::class);
        $theme = $this->fakeSalesItemsData($salesItemsFields);
        return $salesItemsRepo->create($theme);
    }

    /**
     * Get fake instance of SalesItems
     *
     * @param array $salesItemsFields
     * @return SalesItems
     */
    public function fakeSalesItems($salesItemsFields = [])
    {
        return new SalesItems($this->fakeSalesItemsData($salesItemsFields));
    }

    /**
     * Get fake data of SalesItems
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSalesItemsData($salesItemsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'model_id' => $fake->randomDigitNotNull,
            'sale_id' => $fake->randomDigitNotNull,
            'price' => $fake->randomDigitNotNull,
            'qty' => $fake->randomDigitNotNull,
            'total' => $fake->randomDigitNotNull
        ], $salesItemsFields);
    }
}
