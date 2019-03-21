<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Branches
 * @package App\Models
 * @version February 5, 2019, 6:21 pm UTC
 *
 * @property string name
 * @property string type
 */
class Branches extends Model
{
    use SoftDeletes;

    public $table = 'branches';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required'
    ];

    
}
