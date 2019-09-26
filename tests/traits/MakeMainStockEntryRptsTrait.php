<?php

use Faker\Factory as Faker;
use App\Models\MainStockEntryRpts;
use App\Repositories\MainStockEntryRptsRepository;

trait MakeMainStockEntryRptsTrait
{
    /**
     * Create fake instance of MainStockEntryRpts and save it in database
     *
     * @param array $mainStockEntryRptsFields
     * @return MainStockEntryRpts
     */
    public function makeMainStockEntryRpts($mainStockEntryRptsFields = [])
    {
        /** @var MainStockEntryRptsRepository $mainStockEntryRptsRepo */
        $mainStockEntryRptsRepo = App::make(MainStockEntryRptsRepository::class);
        $theme = $this->fakeMainStockEntryRptsData($mainStockEntryRptsFields);
        return $mainStockEntryRptsRepo->create($theme);
    }

    /**
     * Get fake instance of MainStockEntryRpts
     *
     * @param array $mainStockEntryRptsFields
     * @return MainStockEntryRpts
     */
    public function fakeMainStockEntryRpts($mainStockEntryRptsFields = [])
    {
        return new MainStockEntryRpts($this->fakeMainStockEntryRptsData($mainStockEntryRptsFields));
    }

    /**
     * Get fake data of MainStockEntryRpts
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMainStockEntryRptsData($mainStockEntryRptsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mainStockEntryRptsFields);
    }
}
