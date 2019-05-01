<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class stockMovements
 * @package App\Models
 * @version March 28, 2019, 8:11 pm UTC
 *
 * @property integer currenty_qty
 * @property string action
 * @property integer added_qty
 * @property integer messages
 * @property integer model_id
 * @property integer branch_id
 */
class stockMovements extends Model
{
    use SoftDeletes;

    public $table = 'stock_movements';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'currenty_qty',
        'action',
        'reason',
        'added_qty',
        'removed_qty',
        'transfered_qty',
        'messages',
        'model_id',
        'branch_id'
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
        'messages' => 'string',
        'model_id' => 'integer',
        'branch_id' => 'integer'
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
