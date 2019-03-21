<?php

namespace App\Repositories;

use App\Models\Clients;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ClientsRepository
 * @package App\Repositories
 * @version February 5, 2019, 7:06 am UTC
 *
 * @method Clients findWithoutFail($id, $columns = ['*'])
 * @method Clients find($id, $columns = ['*'])
 * @method Clients first($columns = ['*'])
*/
class ClientsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'client_type_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Clients::class;
    }
}
