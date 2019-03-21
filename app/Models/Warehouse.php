<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Warehouse
 * @package App\Models
 * @version March 12, 2019, 7:25 pm UTC
 *
 * @property integer qty
 * @property integer total_entered_qty
 */
class Warehouse extends Model
{
    use SoftDeletes;

    public $table = 'warehouses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'qty',
        'total_entered_qty',
        'model_id',
        'added_qty'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'qty' => 'integer',
        'total_entered_qty' => 'integer',
        'model_id'=>'integer',
        'added_qty'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'added_qty' => 'required',
        'model_id'=> 'required',
    ];

    
}
