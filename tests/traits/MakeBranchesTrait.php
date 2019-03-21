<?php

use Faker\Factory as Faker;
use App\Models\Branches;
use App\Repositories\BranchesRepository;

trait MakeBranchesTrait
{
    /**
     * Create fake instance of Branches and save it in database
     *
     * @param array $branchesFields
     * @return Branches
     */
    public function makeBranches($branchesFields = [])
    {
        /** @var BranchesRepository $branchesRepo */
        $branchesRepo = App::make(BranchesRepository::class);
        $theme = $this->fakeBranchesData($branchesFields);
        return $branchesRepo->create($theme);
    }

    /**
     * Get fake instance of Branches
     *
     * @param array $branchesFields
     * @return Branches
     */
    public function fakeBranches($branchesFields = [])
    {
        return new Branches($this->fakeBranchesData($branchesFields));
    }

    /**
     * Get fake data of Branches
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBranchesData($branchesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'type' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $branchesFields);
    }
}
