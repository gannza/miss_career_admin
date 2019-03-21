<?php

namespace App\Repositories;

use App\Models\Warehouse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WarehouseRepository
 * @package App\Repositories
 * @version March 12, 2019, 7:25 pm UTC
 *
 * @method Warehouse findWithoutFail($id, $columns = ['*'])
 * @method Warehouse find($id, $columns = ['*'])
 * @method Warehouse first($columns = ['*'])
*/
class WarehouseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qty',
        'total_entered_qty'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Warehouse::class;
    }
}
