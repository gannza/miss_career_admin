<?php

use Faker\Factory as Faker;
use App\Models\ClientTypes;
use App\Repositories\ClientTypesRepository;

trait MakeClientTypesTrait
{
    /**
     * Create fake instance of ClientTypes and save it in database
     *
     * @param array $clientTypesFields
     * @return ClientTypes
     */
    public function makeClientTypes($clientTypesFields = [])
    {
        /** @var ClientTypesRepository $clientTypesRepo */
        $clientTypesRepo = App::make(ClientTypesRepository::class);
        $theme = $this->fakeClientTypesData($clientTypesFields);
        return $clientTypesRepo->create($theme);
    }

    /**
     * Get fake instance of ClientTypes
     *
     * @param array $clientTypesFields
     * @return ClientTypes
     */
    public function fakeClientTypes($clientTypesFields = [])
    {
        return new ClientTypes($this->fakeClientTypesData($clientTypesFields));
    }

    /**
     * Get fake data of ClientTypes
     *
     * @param array $postFields
     * @return array
     */
    public function fakeClientTypesData($clientTypesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'discount_value' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $clientTypesFields);
    }
}
