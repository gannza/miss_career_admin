<?php

namespace App\Repositories;

use App\Models\Models;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ModelsRepository
 * @package App\Repositories
 * @version January 21, 2019, 6:21 pm UTC
 *
 * @method Models findWithoutFail($id, $columns = ['*'])
 * @method Models find($id, $columns = ['*'])
 * @method Models first($columns = ['*'])
*/
class ModelsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Models::class;
    }
}
