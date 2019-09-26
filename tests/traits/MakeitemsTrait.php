<?php

use Faker\Factory as Faker;
use App\Models\items;
use App\Repositories\itemsRepository;

trait MakeitemsTrait
{
    /**
     * Create fake instance of items and save it in database
     *
     * @param array $itemsFields
     * @return items
     */
    public function makeitems($itemsFields = [])
    {
        /** @var itemsRepository $itemsRepo */
        $itemsRepo = App::make(itemsRepository::class);
        $theme = $this->fakeitemsData($itemsFields);
        return $itemsRepo->create($theme);
    }

    /**
     * Get fake instance of items
     *
     * @param array $itemsFields
     * @return items
     */
    public function fakeitems($itemsFields = [])
    {
        return new items($this->fakeitemsData($itemsFields));
    }

    /**
     * Get fake data of items
     *
     * @param array $postFields
     * @return array
     */
    public function fakeitemsData($itemsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'cost_price' => $fake->randomDigitNotNull,
            'sale_price' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $itemsFields);
    }
}
