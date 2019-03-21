<?php

namespace App\Repositories;

use App\Models\Items;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ItemsRepository
 * @package App\Repositories
 * @version January 21, 2019, 7:25 pm UTC
 *
 * @method Items findWithoutFail($id, $columns = ['*'])
 * @method Items find($id, $columns = ['*'])
 * @method Items first($columns = ['*'])
*/
class ItemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'cost_price',
        'sale_price',
        'barcode',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Items::class;
    }
}
