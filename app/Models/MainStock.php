<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MainStock
 * @package App\Models
 * @version March 14, 2019, 7:29 pm UTC
 *
 * @property integer qty
 * @property integer total_entered_qty
 * @property integer added_qty
 */
class MainStock extends Model
{
    use SoftDeletes;

    public $table = 'main_stocks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'qty',
        'total_entered_qty',
        'added_qty',
        'model_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'qty' => 'integer',
        'total_entered_qty' => 'integer',
        'added_qty' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'qty' => 'required',
        'total_entered_qty' => 'required',
        'added_qty' => 'required'
    ];

    
}
