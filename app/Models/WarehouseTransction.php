<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WarehouseTransction
 * @package App\Models
 * @version March 12, 2019, 9:41 pm UTC
 *
 * @property integer currenty_qty
 * @property string action
 * @property integer added_qty
 * @property string messages
 */
class WarehouseTransction extends Model
{
    use SoftDeletes;

    public $table = 'warehouse_transctions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'currenty_qty',
        'action',
        'reason',
        'added_qty',
        'removed_qty',
        'transfered_qty',
        'messages',
        'model_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'currenty_qty' => 'integer',
        'action' => 'string',
        'reason' => 'string',
        'added_qty' => 'integer',
        'removed_qty' => 'integer',
        'transfered_qty' => 'integer',
        'messages' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'currenty_qty' => 'required',
        'action' => 'required',
        'added_qty' => 'required'
    ];

    
}
