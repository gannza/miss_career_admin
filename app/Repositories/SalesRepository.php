<?php

namespace App\Repositories;

use App\Models\Sales;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SalesRepository
 * @package App\Repositories
 * @version April 13, 2019, 9:00 am UTC
 *
 * @method Sales findWithoutFail($id, $columns = ['*'])
 * @method Sales find($id, $columns = ['*'])
 * @method Sales first($columns = ['*'])
*/
class SalesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'invoice_date',
        'payment_date',
        'total_amount',
        'amount_due',
        'tax_rate',
        'customer_id',
        'branch_id',
        'operator_id',
        'payment_method',
        'payment_status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sales::class;
    }
}
