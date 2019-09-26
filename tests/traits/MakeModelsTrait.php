<?php

use Faker\Factory as Faker;
use App\Models\Models;
use App\Repositories\ModelsRepository;

trait MakeModelsTrait
{
    /**
     * Create fake instance of Models and save it in database
     *
     * @param array $modelsFields
     * @return Models
     */
    public function makeModels($modelsFields = [])
    {
        /** @var ModelsRepository $modelsRepo */
        $modelsRepo = App::make(ModelsRepository::class);
        $theme = $this->fakeModelsData($modelsFields);
        return $modelsRepo->create($theme);
    }

    /**
     * Get fake instance of Models
     *
     * @param array $modelsFields
     * @return Models
     */
    public function fakeModels($modelsFields = [])
    {
        return new Models($this->fakeModelsData($modelsFields));
    }

    /**
     * Get fake data of Models
     *
     * @param array $postFields
     * @return array
     */
    public function fakeModelsData($modelsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $modelsFields);
    }
}
