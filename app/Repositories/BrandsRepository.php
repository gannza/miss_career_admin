<?php

namespace App\Repositories;

use App\Models\Brands;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BrandsRepository
 * @package App\Repositories
 * @version January 21, 2019, 6:19 pm UTC
 *
 * @method Brands findWithoutFail($id, $columns = ['*'])
 * @method Brands find($id, $columns = ['*'])
 * @method Brands first($columns = ['*'])
*/
class BrandsRepository extends BaseRepository
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
        return Brands::class;
    }
}
