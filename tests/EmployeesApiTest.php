<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeesApiTest extends TestCase
{
    use MakeEmployeesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEmployees()
    {
        $employees = $this->fakeEmployeesData();
        $this->json('POST', '/api/v1/employees', $employees);

        $this->assertApiResponse($employees);
    }

    /**
     * @test
     */
    public function testReadEmployees()
    {
        $employees = $this->makeEmployees();
        $this->json('GET', '/api/v1/employees/'.$employees->id);

        $this->assertApiResponse($employees->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEmployees()
    {
        $employees = $this->makeEmployees();
        $editedEmployees = $this->fakeEmployeesData();

        $this->json('PUT', '/api/v1/employees/'.$employees->id, $editedEmployees);

        $this->assertApiResponse($editedEmployees);
    }

    /**
     * @test
     */
    public function testDeleteEmployees()
    {
        $employees = $this->makeEmployees();
        $this->json('DELETE', '/api/v1/employees/'.$employees->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/employees/'.$employees->id);

        $this->assertResponseStatus(404);
    }
}
