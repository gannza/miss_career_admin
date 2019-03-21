<?php

namespace App\Repositories;

use App\Models\ClientTypes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ClientTypesRepository
 * @package App\Repositories
 * @version February 5, 2019, 6:17 pm UTC
 *
 * @method ClientTypes findWithoutFail($id, $columns = ['*'])
 * @method ClientTypes find($id, $columns = ['*'])
 * @method ClientTypes first($columns = ['*'])
*/
class ClientTypesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'discount_value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ClientTypes::class;
    }
}
