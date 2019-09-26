<?php

use Faker\Factory as Faker;
use App\Models\stockMovements;
use App\Repositories\stockMovementsRepository;

trait MakestockMovementsTrait
{
    /**
     * Create fake instance of stockMovements and save it in database
     *
     * @param array $stockMovementsFields
     * @return stockMovements
     */
    public function makestockMovements($stockMovementsFields = [])
    {
        /** @var stockMovementsRepository $stockMovementsRepo */
        $stockMovementsRepo = App::make(stockMovementsRepository::class);
        $theme = $this->fakestockMovementsData($stockMovementsFields);
        return $stockMovementsRepo->create($theme);
    }

    /**
     * Get fake instance of stockMovements
     *
     * @param array $stockMovementsFields
     * @return stockMovements
     */
    public function fakestockMovements($stockMovementsFields = [])
    {
        return new stockMovements($this->fakestockMovementsData($stockMovementsFields));
    }

    /**
     * Get fake data of stockMovements
     *
     * @param array $postFields
     * @return array
     */
    public function fakestockMovementsData($stockMovementsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'currenty_qty' => $fake->randomDigitNotNull,
            'action' => $fake->word,
            'added_qty' => $fake->randomDigitNotNull,
            'messages' => $fake->randomDigitNotNull,
            'model_id' => $fake->randomDigitNotNull,
            'branch_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $stockMovementsFields);
    }
}
