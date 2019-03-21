<?php

use Faker\Factory as Faker;
use App\Models\Warehouse;
use App\Repositories\WarehouseRepository;

trait MakeWarehouseTrait
{
    /**
     * Create fake instance of Warehouse and save it in database
     *
     * @param array $warehouseFields
     * @return Warehouse
     */
    public function makeWarehouse($warehouseFields = [])
    {
        /** @var WarehouseRepository $warehouseRepo */
        $warehouseRepo = App::make(WarehouseRepository::class);
        $theme = $this->fakeWarehouseData($warehouseFields);
        return $warehouseRepo->create($theme);
    }

    /**
     * Get fake instance of Warehouse
     *
     * @param array $warehouseFields
     * @return Warehouse
     */
    public function fakeWarehouse($warehouseFields = [])
    {
        return new Warehouse($this->fakeWarehouseData($warehouseFields));
    }

    /**
     * Get fake data of Warehouse
     *
     * @param array $postFields
     * @return array
     */
    public function fakeWarehouseData($warehouseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->word,
            'qty' => $fake->randomDigitNotNull,
            'total_entered_qty' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $warehouseFields);
    }
}
