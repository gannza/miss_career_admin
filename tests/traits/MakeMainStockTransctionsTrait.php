<?php

use Faker\Factory as Faker;
use App\Models\MainStockTransctions;
use App\Repositories\MainStockTransctionsRepository;

trait MakeMainStockTransctionsTrait
{
    /**
     * Create fake instance of MainStockTransctions and save it in database
     *
     * @param array $mainStockTransctionsFields
     * @return MainStockTransctions
     */
    public function makeMainStockTransctions($mainStockTransctionsFields = [])
    {
        /** @var MainStockTransctionsRepository $mainStockTransctionsRepo */
        $mainStockTransctionsRepo = App::make(MainStockTransctionsRepository::class);
        $theme = $this->fakeMainStockTransctionsData($mainStockTransctionsFields);
        return $mainStockTransctionsRepo->create($theme);
    }

    /**
     * Get fake instance of MainStockTransctions
     *
     * @param array $mainStockTransctionsFields
     * @return MainStockTransctions
     */
    public function fakeMainStockTransctions($mainStockTransctionsFields = [])
    {
        return new MainStockTransctions($this->fakeMainStockTransctionsData($mainStockTransctionsFields));
    }

    /**
     * Get fake data of MainStockTransctions
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMainStockTransctionsData($mainStockTransctionsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'currenty_qty' => $fake->randomDigitNotNull,
            'action' => $fake->word,
            'added_qty' => $fake->randomDigitNotNull,
            'messages' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mainStockTransctionsFields);
    }
}
