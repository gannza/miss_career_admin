<?php

namespace App\Repositories;

use App\Models\Stocks;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StocksRepository
 * @package App\Repositories
 * @version March 28, 2019, 8:07 pm UTC
 *
 * @method Stocks findWithoutFail($id, $columns = ['*'])
 * @method Stocks find($id, $columns = ['*'])
 * @method Stocks first($columns = ['*'])
*/
class StocksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'total_entered_qty',
        'qty',
        'added_qty',
        'model_id',
        'branch_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Stocks::class;
    }
}
