<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Models
 * @package App\Models
 * @version January 21, 2019, 6:21 pm UTC
 *
 * @property string name
 * @property string description
 */
class Models extends Model
{
    use SoftDeletes;

    public $table = 'models';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'cost_price',
        'sale_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'cost_price'=>'integer',
        'sale_price'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
