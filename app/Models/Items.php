<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Items
 * @package App\Models
 * @version January 21, 2019, 7:25 pm UTC
 *
 * @property string name
 * @property integer cost_price
 * @property integer sale_price
 * @property string barcode
 * @property string description
 */
class Items extends Model
{
    use SoftDeletes;

    public $table = 'items';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'cost_price',
        'sale_price',
        'barcode',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'cost_price' => 'integer',
        'sale_price' => 'integer',
        'barcode' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'cost_price' => 'required',
        'sale_price' => 'required'
    ];

    
}
