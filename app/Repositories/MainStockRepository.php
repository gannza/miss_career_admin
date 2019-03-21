<?php

namespace App\Repositories;

use App\Models\MainStock;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MainStockRepository
 * @package App\Repositories
 * @version March 14, 2019, 7:29 pm UTC
 *
 * @method MainStock findWithoutFail($id, $columns = ['*'])
 * @method MainStock find($id, $columns = ['*'])
 * @method MainStock first($columns = ['*'])
*/
class MainStockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qty',
        'total_entered_qty',
        'added_qty'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MainStock::class;
    }
}
