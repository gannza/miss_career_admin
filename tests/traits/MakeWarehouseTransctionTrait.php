<?php

use Faker\Factory as Faker;
use App\Models\WarehouseTransction;
use App\Repositories\WarehouseTransctionRepository;

trait MakeWarehouseTransctionTrait
{
    /**
     * Create fake instance of WarehouseTransction and save it in database
     *
     * @param array $warehouseTransctionFields
     * @return WarehouseTransction
     */
    public function makeWarehouseTransction($warehouseTransctionFields = [])
    {
        /** @var WarehouseTransctionRepository $warehouseTransctionRepo */
        $warehouseTransctionRepo = App::make(WarehouseTransctionRepository::class);
        $theme = $this->fakeWarehouseTransctionData($warehouseTransctionFields);
        return $warehouseTransctionRepo->create($theme);
    }

    /**
     * Get fake instance of WarehouseTransction
     *
     * @param array $warehouseTransctionFields
     * @return WarehouseTransction
     */
    public function fakeWarehouseTransction($warehouseTransctionFields = [])
    {
        return new WarehouseTransction($this->fakeWarehouseTransctionData($warehouseTransctionFields));
    }

    /**
     * Get fake data of WarehouseTransction
     *
     * @param array $postFields
     * @return array
     */
    public function fakeWarehouseTransctionData($warehouseTransctionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'currenty_qty' => $fake->randomDigitNotNull,
            'action' => $fake->word,
            'added_qty' => $fake->randomDigitNotNull,
            'messages' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $warehouseTransctionFields);
    }
}
