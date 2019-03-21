<?php

namespace App\Repositories;

use App\Models\MainStockTransctions;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MainStockTransctionsRepository
 * @package App\Repositories
 * @version March 14, 2019, 7:32 pm UTC
 *
 * @method MainStockTransctions findWithoutFail($id, $columns = ['*'])
 * @method MainStockTransctions find($id, $columns = ['*'])
 * @method MainStockTransctions first($columns = ['*'])
*/
class MainStockTransctionsRepository extends BaseRepository
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
        return MainStockTransctions::class;
    }
}
