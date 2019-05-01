<?php

namespace App\Repositories;

use App\Models\stockMovements;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class stockMovementsRepository
 * @package App\Repositories
 * @version March 28, 2019, 8:11 pm UTC
 *
 * @method stockMovements findWithoutFail($id, $columns = ['*'])
 * @method stockMovements find($id, $columns = ['*'])
 * @method stockMovements first($columns = ['*'])
*/
class stockMovementsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'currenty_qty',
        'action',
        'added_qty',
        'messages',
        'model_id',
        'branch_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return stockMovements::class;
    }
}
