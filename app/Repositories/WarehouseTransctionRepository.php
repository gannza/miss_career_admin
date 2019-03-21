<?php

namespace App\Repositories;

use App\Models\WarehouseTransction;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WarehouseTransctionRepository
 * @package App\Repositories
 * @version March 12, 2019, 9:41 pm UTC
 *
 * @method WarehouseTransction findWithoutFail($id, $columns = ['*'])
 * @method WarehouseTransction find($id, $columns = ['*'])
 * @method WarehouseTransction first($columns = ['*'])
*/
class WarehouseTransctionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'currenty_qty',
        'action',
        'added_qty',
        'messages'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return WarehouseTransction::class;
    }
}
