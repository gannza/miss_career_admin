<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClientTypes
 * @package App\Models
 * @version February 5, 2019, 6:17 pm UTC
 *
 * @property string name
 * @property integer discount_value
 */
class ClientTypes extends Model
{
    use SoftDeletes;

    public $table = 'client_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'discount_value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'discount_value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'discount_value' => 'required'
    ];
   
    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}
