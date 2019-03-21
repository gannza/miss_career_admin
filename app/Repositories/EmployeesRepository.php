<?php

namespace App\Repositories;

use App\Models\Employees;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EmployeesRepository
 * @package App\Repositories
 * @version February 13, 2019, 7:59 pm UTC
 *
 * @method Employees findWithoutFail($id, $columns = ['*'])
 * @method Employees find($id, $columns = ['*'])
 * @method Employees first($columns = ['*'])
*/
class EmployeesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'role'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Employees::class;
    }
}
