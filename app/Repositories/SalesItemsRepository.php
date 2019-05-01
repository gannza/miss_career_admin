<?php

namespace App\Repositories;

use App\Models\SalesItems;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SalesItemsRepository
 * @package App\Repositories
 * @version April 13, 2019, 9:03 am UTC
 *
 * @method SalesItems findWithoutFail($id, $columns = ['*'])
 * @method SalesItems find($id, $columns = ['*'])
 * @method SalesItems first($columns = ['*'])
*/
class SalesItemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'model_id',
        'sale_id',
        'price',
        'qty',
        'total'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SalesItems::class;
    }
}
