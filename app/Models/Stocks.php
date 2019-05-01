<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stocks
 * @package App\Models
 * @version March 28, 2019, 8:07 pm UTC
 *
 * @property integer total_entered_qty
 * @property integer qty
 * @property integer added_qty
 * @property integer model_id
 * @property integer branch_id
 */
class Stocks extends Model
{
    use SoftDeletes;

    public $table = 'stocks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'total_entered_qty',
        'qty',
        'added_qty',
        'model_id',
        'branch_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'added_qty' => 'integer',
        'model_id' => 'integer',
        'branch_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'added_qty' => 'required',
        'model_id' => 'required',
        'branch_id' => 'required',
    ];

    
}
