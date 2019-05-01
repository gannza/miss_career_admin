<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sales
 * @package App\Models
 * @version April 13, 2019, 9:00 am UTC
 *
 * @property date invoice_date
 * @property date payment_date
 * @property integer total_amount
 * @property integer amount_due
 * @property integer tax_rate
 * @property integer customer_id
 * @property integer branch_id
 * @property integer operator_id
 * @property string payment_method
 * @property string payment_status
 */
class Sales extends Model
{
    use SoftDeletes;

    public $table = 'sales';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'invoice_date',
        'payment_date',
        'total_amount',
        'amount_due',
        'tax_rate',
        'currency',
        'customer_id',
        'branch_id',
        'operator_id',
        'payment_method',
        'payment_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'invoice_date' => 'date',
        'payment_date' => 'date',
        'total_amount' => 'decimal',
        'amount_due' => 'decimal',
        'tax_rate' => 'decimal',
        'currency' => 'string',
        'customer_id' => 'integer',
        'branch_id' => 'integer',
        'operator_id' => 'integer',
        'payment_method' => 'string',
        'payment_status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'invoice_date' => 'required',
        'branch_id' => 'required',
        'customer_id' => 'required',
        'payment_date' => 'required'
    ];

    
}
