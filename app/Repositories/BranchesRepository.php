<?php

namespace App\Repositories;

use App\Models\Branches;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BranchesRepository
 * @package App\Repositories
 * @version February 5, 2019, 6:21 pm UTC
 *
 * @method Branches findWithoutFail($id, $columns = ['*'])
 * @method Branches find($id, $columns = ['*'])
 * @method Branches first($columns = ['*'])
*/
class BranchesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Branches::class;
    }
}
