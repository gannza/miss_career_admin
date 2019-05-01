<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SalesItems
 * @package App\Models
 * @version April 13, 2019, 9:03 am UTC
 *
 * @property integer model_id
 * @property integer sale_id
 * @property integer price
 * @property integer qty
 * @property integer total
 */
class SalesItems extends Model
{
    //use SoftDeletes;

    public $table = 'sales_items';
    

    //protected $dates = ['deleted_at'];


    public $fillable = [
        'model_id',
        'sale_id',
        'price',
        'qty',
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'model_id' => 'integer',
        'sale_id' => 'integer',
        'price' => 'integer',
        'qty' => 'integer',
        'total' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
