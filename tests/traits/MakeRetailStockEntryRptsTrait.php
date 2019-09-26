<?php

use Faker\Factory as Faker;
use App\Models\RetailStockEntryRpts;
use App\Repositories\RetailStockEntryRptsRepository;

trait MakeRetailStockEntryRptsTrait
{
    /**
     * Create fake instance of RetailStockEntryRpts and save it in database
     *
     * @param array $retailStockEntryRptsFields
     * @return RetailStockEntryRpts
     */
    public function makeRetailStockEntryRpts($retailStockEntryRptsFields = [])
    {
        /** @var RetailStockEntryRptsRepository $retailStockEntryRptsRepo */
        $retailStockEntryRptsRepo = App::make(RetailStockEntryRptsRepository::class);
        $theme = $this->fakeRetailStockEntryRptsData($retailStockEntryRptsFields);
        return $retailStockEntryRptsRepo->create($theme);
    }

    /**
     * Get fake instance of RetailStockEntryRpts
     *
     * @param array $retailStockEntryRptsFields
     * @return RetailStockEntryRpts
     */
    public function fakeRetailStockEntryRpts($retailStockEntryRptsFields = [])
    {
        return new RetailStockEntryRpts($this->fakeRetailStockEntryRptsData($retailStockEntryRptsFields));
    }

    /**
     * Get fake data of RetailStockEntryRpts
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRetailStockEntryRptsData($retailStockEntryRptsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $retailStockEntryRptsFields);
    }
}
