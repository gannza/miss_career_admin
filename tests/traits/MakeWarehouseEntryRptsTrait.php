<?php

use Faker\Factory as Faker;
use App\Models\WarehouseEntryRpts;
use App\Repositories\WarehouseEntryRptsRepository;

trait MakeWarehouseEntryRptsTrait
{
    /**
     * Create fake instance of WarehouseEntryRpts and save it in database
     *
     * @param array $warehouseEntryRptsFields
     * @return WarehouseEntryRpts
     */
    public function makeWarehouseEntryRpts($warehouseEntryRptsFields = [])
    {
        /** @var WarehouseEntryRptsRepository $warehouseEntryRptsRepo */
        $warehouseEntryRptsRepo = App::make(WarehouseEntryRptsRepository::class);
        $theme = $this->fakeWarehouseEntryRptsData($warehouseEntryRptsFields);
        return $warehouseEntryRptsRepo->create($theme);
    }

    /**
     * Get fake instance of WarehouseEntryRpts
     *
     * @param array $warehouseEntryRptsFields
     * @return WarehouseEntryRpts
     */
    public function fakeWarehouseEntryRpts($warehouseEntryRptsFields = [])
    {
        return new WarehouseEntryRpts($this->fakeWarehouseEntryRptsData($warehouseEntryRptsFields));
    }

    /**
     * Get fake data of WarehouseEntryRpts
     *
     * @param array $postFields
     * @return array
     */
    public function fakeWarehouseEntryRptsData($warehouseEntryRptsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $warehouseEntryRptsFields);
    }
}
