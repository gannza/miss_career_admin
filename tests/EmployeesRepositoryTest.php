<?php

use App\Models\Employees;
use App\Repositories\EmployeesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeesRepositoryTest extends TestCase
{
    use MakeEmployeesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmployeesRepository
     */
    protected $employeesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->employeesRepo = App::make(EmployeesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEmployees()
    {
        $employees = $this->fakeEmployeesData();
        $createdEmployees = $this->employeesRepo->create($employees);
        $createdEmployees = $createdEmployees->toArray();
        $this->assertArrayHasKey('id', $createdEmployees);
        $this->assertNotNull($createdEmployees['id'], 'Created Employees must have id specified');
        $this->assertNotNull(Employees::find($createdEmployees['id']), 'Employees with given id must be in DB');
        $this->assertModelData($employees, $createdEmployees);
    }

    /**
     * @test read
     */
    public function testReadEmployees()
    {
        $employees = $this->makeEmployees();
        $dbEmployees = $this->employeesRepo->find($employees->id);
        $dbEmployees = $dbEmployees->toArray();
        $this->assertModelData($employees->toArray(), $dbEmployees);
    }

    /**
     * @test update
     */
    public function testUpdateEmployees()
    {
        $employees = $this->makeEmployees();
        $fakeEmployees = $this->fakeEmployeesData();
        $updatedEmployees = $this->employeesRepo->update($fakeEmployees, $employees->id);
        $this->assertModelData($fakeEmployees, $updatedEmployees->toArray());
        $dbEmployees = $this->employeesRepo->find($employees->id);
        $this->assertModelData($fakeEmployees, $dbEmployees->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEmployees()
    {
        $employees = $this->makeEmployees();
        $resp = $this->employeesRepo->delete($employees->id);
        $this->assertTrue($resp);
        $this->assertNull(Employees::find($employees->id), 'Employees should not exist in DB');
    }
}
