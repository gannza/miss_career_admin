<?php

use Faker\Factory as Faker;
use App\Models\Employees;
use App\Repositories\EmployeesRepository;

trait MakeEmployeesTrait
{
    /**
     * Create fake instance of Employees and save it in database
     *
     * @param array $employeesFields
     * @return Employees
     */
    public function makeEmployees($employeesFields = [])
    {
        /** @var EmployeesRepository $employeesRepo */
        $employeesRepo = App::make(EmployeesRepository::class);
        $theme = $this->fakeEmployeesData($employeesFields);
        return $employeesRepo->create($theme);
    }

    /**
     * Get fake instance of Employees
     *
     * @param array $employeesFields
     * @return Employees
     */
    public function fakeEmployees($employeesFields = [])
    {
        return new Employees($this->fakeEmployeesData($employeesFields));
    }

    /**
     * Get fake data of Employees
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEmployeesData($employeesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'email' => $fake->word,
            'phone' => $fake->word,
            'role' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $employeesFields);
    }
}
